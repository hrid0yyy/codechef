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
    const runButton = document.getElementById("runButton");
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
      monaco.editor.setModelLanguage(
        editor.getModel(),
        selectedLanguage === "cpp" ? "cpp" : selectedLanguage
      );
    });

    // Handle run button click
    runButton.addEventListener("click", async () => {
      const language = languageSelect.value;
      const urlParams = new URLSearchParams(window.location.search);
      const problemId = urlParams.get("problem_id");
      const contestId = urlParams.get("contest_id");
      const code = editor.getValue();

      if (!code || !problemId || !language || !contestId) {
        appendToTerminal(
          "Error: Code, Problem ID, Contest ID, and Language are required."
        );
        return;
      }

      terminal.innerHTML = "Executing code...\n";

      // Ensure `userId` is available globally (from session or elsewhere)

      if (typeof userId === "undefined") {
        appendToTerminal("Error: User ID not found.");
        return;
      }

      try {
        // Send the code to backend for execution
        const response = await fetch("http://localhost:8000/contest/execute", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            userId,
            language,
            code,
            problemId,
            contestId,
          }),
        });

        const data = await response.json();
        if (data.error) {
          appendToTerminal(`Error: ${data.error}`);
        } else {
          appendToTerminal(
            `Verdict: ${data.solved ? "Accepted" : "Wrong Answer"}`,
            data.solved
          );
        }
      } catch (err) {
        console.error("Execution error:", err);
        appendToTerminal(`Error: ${err.message}`);
      }
    });

    // Initialize with default C++ code
    setDefaultCode("cpp");
  });
});
