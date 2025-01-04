document.addEventListener("DOMContentLoaded", () => {
  require.config({
    paths: {
      vs: "https://cdn.jsdelivr.net/npm/monaco-editor@0.34.1/min/vs",
    },
  });

  require(["vs/editor/editor.main"], function () {
    // Initialize Monaco editor
    const editor = monaco.editor.create(document.getElementById("editor"), {
      value: "// Write your code here...",
      language: "cpp",
      automaticLayout: true,
    });

    // DOM Elements
    const terminal = document.getElementById("terminal");
    const runButton = document.getElementById("run");
    const languageSelect = document.getElementById("language");

    // Function to append output to the terminal
    function appendToTerminal(text, isSuccess = false) {
      const line = document.createElement("div");
      line.textContent = text;
      line.style.color = isSuccess ? "lightgreen" : "red";
      terminal.appendChild(line);
      terminal.scrollTop = terminal.scrollHeight;
    }

    // Language code snippets
    const defaultCodeSnippets = {
      cpp: `#include <iostream>
using namespace std;

int main() {
    // Your code here
    return 0;
}`,
      c: `#include <stdio.h>

int main() {
    // Your code here
    return 0;
}`,
      python: `# Write your code here

if __name__ == "__main__":
    pass`,
      javascript: `// Write your code here

function main() {
    console.log("Hello, world!");
}
main();`,
      java: `public class Code {
    public static void main(String[] args) {
        // Your code here
    }
}`,
    };

    // Set default code in the editor based on language selection
    function setDefaultCode(language) {
      const defaultCode =
        defaultCodeSnippets[language] || "// Write your code here...";
      editor.setValue(defaultCode);
    }

    // Handle language change
    languageSelect.addEventListener("change", (event) => {
      const selectedLanguage = event.target.value;
      editor.setValue(defaultCodeSnippets[selectedLanguage]);
      editor
        .getModel()
        .setMode(selectedLanguage === "cpp" ? "cpp" : selectedLanguage);
    });

    // Handle run button click
    runButton.addEventListener("click", () => {
      const language = languageSelect.value;
      const urlParams = new URLSearchParams(window.location.search);
      const problemId = urlParams.get("problem_id");
      const code = editor.getValue();

      if (!code || !problemId || !language) {
        appendToTerminal("Error: Code, Problem ID, and Language are required.");
        return;
      }

      terminal.innerHTML = "Executing code...\n";
      // Ensure `userId` is globally available
      if (typeof userId === "undefined") {
        appendToTerminal("Error: User ID not found.");
        return;
      }

      // Send the code to backend for execution
      fetch("http://localhost:8000/execute", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ userId, language, code, problemId }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            appendToTerminal(`Error: ${data.error}`);
          } else {
            appendToTerminal(
              `Verdict: ${data.verdict}`,
              data.verdict === "Accepted"
            );
            appendToTerminal(`Run Time: ${data.avgRuntime} ms`);
          }
        })
        .catch((err) => {
          console.error("Execution error:", err);
          appendToTerminal(`Error: ${err.message}`);
        });
    });

    // Initialize with default C++ code
    setDefaultCode("cpp");
  });

  // Fetch problem details
  async function fetchProblemDetails() {
    const urlParams = new URLSearchParams(window.location.search);
    const problemId = urlParams.get("problem_id");

    if (!problemId) {
      document.getElementById("problem-title").textContent =
        "Problem ID not found";
      return;
    }

    try {
      const response = await fetch(
        `backend/up/get_problem.php?problem_id=${problemId}`
      );
      const data = await response.json();

      if (data.status !== "success") {
        document.getElementById("problem-title").textContent =
          "Problem not found";
        return;
      }

      // Update UI with problem data
      document.getElementById("problem-title").textContent =
        data.problem.problem_title;
      document.getElementById("problem-description").textContent =
        data.problem.description;
      document.getElementById("input-format").textContent =
        data.problem.input_format;
      document.getElementById("output-format").textContent =
        data.problem.output_format;
      document.getElementById("solved-count").textContent = data.total_solved;

      // Populate examples
      const exampleTestsDiv = document.getElementById("example-tests");
      exampleTestsDiv.innerHTML = "";
      data.samples.forEach((sample) => {
        exampleTestsDiv.innerHTML += `
                    <pre class="bg-gray-100 p-4 rounded-lg overflow-x-auto text-sm text-gray-700">
<strong>Input:</strong> ${sample.sample_input}

<strong>Output:</strong> ${sample.sample_output}
                    </pre>
                `;
      });
    } catch (error) {
      console.error("Error fetching problem details:", error);
      document.getElementById("problem-title").textContent =
        "Error loading problem";
    }
  }

  // Fetch problem details when page loads
  fetchProblemDetails();
});
