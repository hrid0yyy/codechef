<?php
require 'backend/ud/session.php'; // Load session data
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="compiler.js"></script>
    <script src="script/compiler.js"></script>
    <link
      rel="icon"
      type="image/x-icon"
      href="assets/img/background/fav-logo.png"
    />
    <title>CodeCraft Problem</title>
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
     
      <div
        class="flex justify-between items-center  text-purple-800 font-semibold rounded-lg p-4"
      >
      <button
          onclick="history.back()"
          class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full"
        >
          &larr; Back
        </button>
        <div class="mt-4">
    <span>Solved By: <span id="solved-count" class="font-bold">X</span> users</span>
</div>

      </div>

      <!-- Content Section -->
      <div class="flex space-x-8">
        <!-- Problem Details -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6">
        <h2 id="problem-title" class="text-2xl font-semibold text-purple-600">Loading...</h2>
        <p id="problem-description" class="text-gray-700 mt-4"></p>

        <!-- Input Format -->
        <h3 class="text-lg font-semibold text-gray-800 mt-4">Input Format:</h3>
        <pre id="input-format" class="bg-gray-100 p-4 rounded-lg overflow-x-auto text-sm text-gray-700"></pre>

        <!-- Output Format -->
        <h3 class="text-lg font-semibold text-gray-800 mt-4">Output Format:</h3>
        <pre id="output-format" class="bg-gray-100 p-4 rounded-lg overflow-x-auto text-sm text-gray-700"></pre>

        <!-- Example Test Cases -->
        <h3 class="text-lg font-semibold text-gray-800 mt-4">Example:</h3>
        <div id="example-tests"></div>


         
        </div>

        <!-- Code Editor Section -->
        <div class="flex-1 bg-gray-50 border border-gray-300 rounded-lg p-6">
          
          <div class="flex justify-between items-center mb-4">
            <select
              id="language"
              class="border border-gray-300 rounded px-4 py-2 text-sm"
            >
            <option value="cpp">C++</option>
              <option value="c">C</option>
              <option value="java">Java</option>
            </select>
           
          </div>
          <div id="editor" class="bg-gray-800 rounded"></div>
          <div class="flex justify-center mt-6">
            <button
              id="run"
              class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full"
            >
              Run
            </button>
          </div>
           <!-- Output Box -->
           <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Output:</h3>
            <div id="terminal" class="shadow-inner"></div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/monaco-editor@0.34.1/min/vs/loader.js"></script>
  </body>
</html>
