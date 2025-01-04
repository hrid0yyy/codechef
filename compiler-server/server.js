const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
const { exec } = require("child_process");
const fs = require("fs");
const mysql = require("mysql");

const app = express();
const PORT = 8000;

// Middleware
app.use(cors());
app.use(bodyParser.json());

// MySQL Connection
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "codecraft",
});

db.connect((err) => {
  if (err) throw err;
  console.log("MySQL connected.");
});

app.get("/", (req, res) => {
  res.send("Welcome to CodeCraft! Your server is running on localhost:8000.");
});

// Commands for compiling and executing code
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

// Execute test cases and store results
async function executeTestCases(testCases, language, res, userId, problemId) {
  const results = [];
  const fileExtension = language === "javascript" ? "js" : language;
  const fileName = `code.${fileExtension}`;
  const inputFileName = "input.txt";
  let totalRuntime = 0;
  let verdict = "Accepted"; // Default to Accepted, change if a test case fails

  if (compileCommands[language]) {
    try {
      await new Promise((resolve, reject) => {
        exec(compileCommands[language], (error, stdout, stderr) => {
          if (error || stderr) {
            return reject({
              type: "Compilation Error",
              message: stderr || error.message,
            });
          }
          resolve();
        });
      });
    } catch (compilationError) {
      console.error("Compilation Error:", compilationError.message);
      verdict = "Compilation Error";
      return saveSubmission(userId, problemId, verdict, res, 0);
    }
  }

  for (let i = 0; i < testCases.length; i++) {
    const { sample_input, sample_output } = testCases[i];
    fs.writeFileSync(inputFileName, sample_input);

    const startTime = process.hrtime();
    try {
      const output = await new Promise((resolve, reject) => {
        const processExec = exec(
          executeCommands[language],
          { timeout: 5000 },
          (error, stdout, stderr) => {
            if (error) {
              if (error.killed) {
                return reject({
                  type: "Runtime Error",
                  message: "Execution Timeout (Infinite Loop)",
                });
              }
              return reject({
                type: "Runtime Error",
                message: stderr || error.message,
              });
            }
            resolve(stdout.trim());
          }
        );

        setTimeout(() => {
          processExec.kill();
        }, 5000);
      });

      const endTime = process.hrtime(startTime);
      const runtime = endTime[0] * 1000 + endTime[1] / 1e6; // Convert to ms
      totalRuntime += runtime;

      if (output !== sample_output.trim()) {
        verdict = "Wrong Answer";
      }

      results.push({
        case: i + 1,
        status: output === sample_output.trim() ? "Pass" : "Fail",
        output,
        expected_output: sample_output,
      });
    } catch (executionError) {
      console.error(
        `Execution Error in Test Case ${i + 1}:`,
        executionError.message
      );
      verdict = executionError.type;
      return saveSubmission(userId, problemId, verdict, res, 0);
    }
  }

  if (fs.existsSync(fileName)) fs.unlinkSync(fileName);
  if (fs.existsSync(inputFileName)) fs.unlinkSync(inputFileName);
  if (fs.existsSync("code.exe")) fs.unlinkSync("code.exe");

  const avgRuntime = totalRuntime / testCases.length;
  saveSubmission(userId, problemId, verdict, res, avgRuntime);
}

// Save submission and update user problem count
function saveSubmission(userId, problemId, verdict, res, runTime) {
  const query = `INSERT INTO submissions (user_id, problem_id, status, submission_time, RunTime) VALUES (?, ?, ?, NOW(), ?)`;

  db.query(query, [userId, problemId, verdict, runTime], (err, result) => {
    if (err) {
      console.error("Error inserting submission:", err);
      return res.status(500).json({ error: "Failed to insert submission." });
    }

    if (verdict === "Accepted") {
      updateUserProblemStatus(userId, problemId, res);
    } else {
      res.json({ verdict, runTime });
    }
  });
}

// Update user_problem_status and total_problems_solved
function updateUserProblemStatus(userId, problemId, res) {
  const checkQuery = `SELECT * FROM user_problem_status WHERE user_id = ? AND problem_id = ?`;

  db.query(checkQuery, [userId, problemId], (err, results) => {
    if (err) {
      console.error("Database Error:", err);
      return res.status(500).json({ error: "Database error." });
    }

    if (results.length === 0) {
      const insertQuery = `INSERT INTO user_problem_status (user_id, problem_id) VALUES (?, ?)`;
      db.query(insertQuery, [userId, problemId], (err) => {
        if (err) {
          console.error("Error inserting into user_problem_status:", err);
          return res
            .status(500)
            .json({ error: "Failed to update problem status." });
        }

        const updateQuery = `UPDATE users SET total_problems_solved = total_problems_solved + 1 WHERE user_id = ?`;
        db.query(updateQuery, [userId], (err) => {
          if (err) {
            console.error("Error updating total problems solved:", err);
            return res
              .status(500)
              .json({ error: "Failed to update user stats." });
          }

          res.json({
            verdict: "Accepted",
            message: "Problem solved count updated!",
          });
        });
      });
    } else {
      res.json({ verdict: "Accepted", message: "Problem already solved!" });
    }
  });
}

// Endpoint to execute code
app.post("/execute", async (req, res) => {
  const { userId, language, code, problemId } = req.body;
  console.log(userId, code, problemId);
  if (!userId || !code || !problemId) {
    return res
      .status(400)
      .json({ error: "User ID, Code, and Problem ID are required" });
  }

  if (!executeCommands[language]) {
    console.error(`Command not found for language: ${language}`);
    return res.status(400).json({ error: `Unsupported language: ${language}` });
  }

  const query = `SELECT sample_input, sample_output FROM problem_samples WHERE problem_id = ?`;
  db.query(query, [problemId], async (err, testCases) => {
    if (err) {
      console.error("Database Error:", err.message);
      return res.status(500).json({ error: "Database error." });
    }
    if (testCases.length === 0) {
      console.error("No Test Cases Found for Problem ID:", problemId);
      return res
        .status(404)
        .json({ error: "No test cases found for the problem." });
    }

    const fileExtension = language === "javascript" ? "js" : language;
    const fileName = `code.${fileExtension}`;

    fs.writeFileSync(fileName, code);
    await executeTestCases(testCases, language, res, userId, problemId);
  });
});

// Start server
app.listen(PORT, () => {
  console.log(`Server running at http://localhost:${PORT}`);
});
