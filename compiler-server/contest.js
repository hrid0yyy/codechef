const express = require("express");
const router = express.Router();
const fs = require("fs");
const { exec } = require("child_process");
const mysql = require("mysql");
// MySQL Connection
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "codecraft",
});

const compileCommands = {
  cpp:
    process.platform === "win32"
      ? `g++ code.cpp -o code.exe`
      : `g++ code.cpp -o code.out`,
  c:
    process.platform === "win32"
      ? `gcc code.c -o code.exe`
      : `gcc code.c -o code.out`,
  java: `javac Code.java`,
};

const executeCommands = {
  cpp:
    process.platform === "win32"
      ? `code.exe < input.txt`
      : `./code.out < input.txt`,
  c:
    process.platform === "win32"
      ? `code.exe < input.txt`
      : `./code.out < input.txt`,
  python: `python code.py < input.txt`,
  javascript: `node code.js < input.txt`,
  java: `java Code < input.txt`,
};

// Function to execute test cases
async function executeTestCases(
  testCases,
  language,
  res,
  userId,
  problemId,
  contestId
) {
  const fileExtension = language === "javascript" ? "js" : language;
  const fileName = `code.${fileExtension}`;
  const inputFileName = "input.txt";
  let verdict = "Accepted"; // Default to Accepted, change if a test case fails

  // Compile the code if necessary
  if (compileCommands[language]) {
    try {
      await new Promise((resolve, reject) => {
        exec(compileCommands[language], (error, stdout, stderr) => {
          if (error || stderr) {
            return reject("Compilation Error");
          }
          resolve();
        });
      });
    } catch {
      verdict = "Compilation Error";
      return saveSubmission(userId, problemId, contestId, 0, res);
    }
  }

  // Execute each test case
  for (let i = 0; i < testCases.length; i++) {
    const { sample_input, sample_output } = testCases[i];
    fs.writeFileSync(inputFileName, sample_input);

    try {
      const output = await new Promise((resolve, reject) => {
        const processExec = exec(
          executeCommands[language],
          { timeout: 5000 },
          (error, stdout) => {
            if (error) return reject("Runtime Error");
            resolve(stdout.trim());
          }
        );

        setTimeout(() => {
          processExec.kill();
        }, 5000);
      });

      if (output !== sample_output.trim()) {
        verdict = "Wrong Answer";
        break; // Stop further test cases if one fails
      }
    } catch {
      verdict = "Runtime Error";
      break;
    }
  }

  // Clean up temporary files
  if (fs.existsSync(fileName)) fs.unlinkSync(fileName);
  if (fs.existsSync(inputFileName)) fs.unlinkSync(inputFileName);
  if (fs.existsSync("code.exe")) fs.unlinkSync("code.exe");

  // Save the submission with solved = 1 if verdict is "Accepted", else 0
  const solved = verdict === "Accepted" ? 1 : 0;
  saveSubmission(userId, problemId, contestId, solved, res);
}

// Function to save submissions
function saveSubmission(userId, problemId, contestId, solved, res) {
  const query = `
    INSERT INTO user_problem_submissions (user_id, contest_id, problem_id, solved)
    VALUES (?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
    solved = GREATEST(solved, VALUES(solved))
  `;

  db.query(query, [userId, contestId, problemId, solved], (err) => {
    if (err) {
      console.error("Error saving submission:", err);
      return res.status(500).json({ error: "Failed to save submission." });
    }

    // Return the result
    res.json({ solved });
  });
}

// Main route to handle code execution
router.post("/execute", async (req, res) => {
  const { userId, language, code, problemId, contestId } = req.body;

  // Validate required fields
  if (!userId || !language || !code || !problemId || !contestId) {
    return res.status(400).json({
      error:
        "User ID, Language, Code, Problem ID, and Contest ID are required.",
    });
  }

  // Check if language is supported
  if (!executeCommands[language]) {
    return res.status(400).json({ error: `Unsupported language: ${language}` });
  }

  // Fetch test cases for the problem
  const query = `SELECT sample_input, sample_output FROM contest_problem_samples WHERE problem_id = ? AND contest_id = ?`;
  db.query(query, [problemId, contestId], async (err, testCases) => {
    if (err) {
      console.error("Database Error:", err.message);
      return res.status(500).json({ error: "Database error." });
    }
    if (testCases.length === 0) {
      return res
        .status(404)
        .json({ error: "No test cases found for the problem." });
    }

    // Write code to a file and execute test cases
    const fileExtension = language === "javascript" ? "js" : language;
    const fileName = `code.${fileExtension}`;

    fs.writeFileSync(fileName, code);
    await executeTestCases(
      testCases,
      language,
      res,
      userId,
      problemId,
      contestId
    );
  });
});

// Export the router
module.exports = router;
