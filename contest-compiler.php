<?php
require 'backend/ud/session.php'; // Load session data
?>
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
        <h1 id="contest-title" class="text-3xl font-bold text-center flex-1">
          Ongoing Contest: Loading...
        </h1>
      </header>

      <!-- Timer Section and Problem Stats -->
      <div
        class="flex justify-between items-center bg-purple-100 text-purple-800 font-semibold rounded-lg p-4"
      >
        <div>
          <span>
            End Time: <span id="end-time" class="font-bold">--:--:--</span>
          </span>
        </div>
        <div>
          <span>
            Solved: <span id="solved-count" class="font-bold">0</span>
          </span>
        </div>
      </div>

      <!-- Content Section -->
      <div class="flex space-x-8">
        <!-- Problem Details -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6">
          <h2 id="problem-title" class="text-2xl font-semibold text-purple-600">
            Loading...
          </h2>
          <p id="problem-description" class="text-gray-700 mt-4">
            Loading problem description...
          </p>

          <pre
            id="problem-example"
            class="bg-gray-100 p-4 rounded-lg overflow-x-auto text-sm text-gray-700 mt-4"
          >
Loading example...
          </pre>

          <!-- Output Box -->
          <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Output:</h3>
            <div id="terminal" class="shadow-inner"></div>
          </div>
        </div>

        <!-- Code Editor Section -->
        <div class="flex-1 bg-gray-50 border border-gray-300 rounded-lg p-6">
         
          <div class="flex justify-between items-center mb-4">
            <select
              id="language"
              class="border border-gray-300 rounded px-4 py-2 text-sm"
            >
              <option value="cpp">Cpp</option>
              <option value="c">C </option>
              <option value="java">Java</option>
            </select>
           
          </div>
          <div id="editor" class="bg-gray-800 rounded"></div>
          <div class="flex justify-center mt-6">
            <button
              id="runButton"
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
    

      // Fetch Contest and Problem Details
      async function fetchProblemDetails(contestId, problemId) {
        try {
          const response = await fetch(
            `backend/contest/compiler-details.php?contest_id=${contestId}&problem_id=${problemId}`
          );
        

          const data = await response.json();

          // Populate contest and problem details
          document.getElementById("contest-title").textContent =
            `Ongoing Contest: ${data.contest_details.contest_name}`;
          document.getElementById("end-time").textContent = new Date(
            data.contest_details.end_time
          ).toLocaleString();
          document.getElementById("solved-count").textContent =
            data.solved_count;

          document.getElementById("problem-title").textContent =
            data.problem_details.problem_title;
          document.getElementById("problem-description").textContent =
            data.problem_details.description;
            document.getElementById("problem-example").textContent = 
    "Input Format:\n" + data.problem_details.input_format + 
    "\n\nOutput Format:\n" + data.problem_details.output_format;

          document.getElementById("problem-id").value =
            data.problem_details.problem_id;
        } catch (error) {
          console.error("Error fetching details:", error);
        
        }
      }

      // Get contest_id and problem_id from URL
      const urlParams = new URLSearchParams(window.location.search);
      const contestId = urlParams.get("contest_id");
      const problemId = urlParams.get("problem_id");

      // Fetch details on page load
      if (contestId && problemId) {
        fetchProblemDetails(contestId, problemId);
      } else {
        alert("Invalid contest or problem ID.");
      }
    </script>
      <script src="script/contest-compiler.js"></script>
  </body>
</html>
