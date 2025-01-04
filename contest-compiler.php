<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="icon"
      type="image/x-icon"
      href="assets/img/background/fav-logo.png"
    />
    <title>CodeCraft Contest - Ongoing</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");

      * {
        font-family: "Syne", serif;
        font-optical-sizing: auto;
        font-style: normal;
      }
      #editor {
        height: 60vh;
      }
      #terminal {
        background-color: #1f2937;
        color: #d1d5db;
        overflow-y: auto;
        height: 20vh;
        padding: 10px;
        border-radius: 0.375rem;
      }
    </style>
  </head>
  <body class="bg-gray-100 min-h-screen">
    <main class="p-8 space-y-8">
      <!-- Header -->
      <header class="flex justify-between items-center">
        <button
          onclick="history.back()"
          class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full"
        >
          &larr; Back
        </button>
        <h1 class="text-3xl font-bold text-center flex-1">
          Ongoing Contest: CodeCraft Challenge
        </h1>
      </header>

      <!-- Timer Section and Problem Stats -->
      <div
        class="flex justify-between items-center bg-purple-100 text-purple-800 font-semibold rounded-lg p-4"
      >
        <div>
          <span
            >Time Left: <span id="timer" class="font-bold">00:45:23</span></span
          >
        </div>
        <div>
          <span
            >Solved: <span class="font-bold">50</span> /
            <span class="font-bold">200</span></span
          >
        </div>
      </div>

      <!-- Content Section -->
      <div class="flex space-x-8">
        <!-- Problem Details -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6">
          <h2 class="text-2xl font-semibold text-purple-600">
            2559. Count Vowel Strings in Ranges
          </h2>
          <p class="text-gray-700 mt-4">
            You are given a 0-indexed array of strings
            <strong>words</strong> and a 2D array of integers
            <strong>queries</strong>.
          </p>

          <pre
            class="bg-gray-100 p-4 rounded-lg overflow-x-auto text-sm text-gray-700 mt-4"
          >
<strong>Example:</strong>
Input: words = ["aba","bcb","ece","aa","e"], queries = [[0,2],[1,4],[1,1]]
Output: [2,3,0]
                </pre>

          <!-- Output Box -->
          <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Output:</h3>
            <div id="terminal" class="shadow-inner"></div>
          </div>
        </div>

        <!-- Code Editor Section -->
        <div class="flex-1 bg-gray-50 border border-gray-300 rounded-lg p-6">
          <div class="mb-4">
            <label
              for="problem-id"
              class="block mb-2 font-medium text-gray-800"
            >
              Problem ID:
            </label>
            <input
              id="problem-id"
              type="text"
              placeholder="Enter Problem ID"
              class="border border-gray-300 rounded px-4 py-2 w-full"
            />
          </div>
          <div class="flex justify-between items-center mb-4">
            <select
              id="language"
              class="border border-gray-300 rounded px-4 py-2 text-sm"
            >
              <option value="c">C</option>
              <option value="cpp">C++</option>
              <option value="java">Java</option>
            </select>
            <button
              id="run"
              class="text-sm bg-purple-500 text-white px-4 py-1 rounded"
            >
              Run
            </button>
          </div>
          <div id="editor" class="bg-gray-800 rounded"></div>
          <div class="flex justify-center mt-6">
            <button
              id="submit"
              class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full"
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/monaco-editor@0.34.1/min/vs/loader.js"></script>
    <script>
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
        const problemIdInput = document.getElementById("problem-id");
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
          const problemId = problemIdInput.value.trim(); // Get Problem ID
          const code = editor.getValue(); // Get code from editor

          if (!code || !problemId || !language) {
            appendToTerminal(
              "Error: Code, Problem ID, and Language are required."
            );
            return;
          }

          terminal.innerHTML = "Executing code...\n"; // Clear terminal and show executing message

          // Send the code to backend for execution
          fetch("http://localhost:3000/execute", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ language, code, problemId }),
          })
            .then((response) => response.json())
            .then((data) => {
              // Handle the response from the backend
              if (data.error) {
                appendToTerminal(`Error: ${data.error}`);
              } else {
                appendToTerminal(
                  `Verdict: ${data.verdict}`,
                  data.verdict === "Accepted" // Set color based on verdict
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
    </script>
  </body>
</html>
