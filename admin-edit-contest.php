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
    <title>Admin - Contest Details</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");

      * {
        font-family: "Syne", serif;
        font-optical-sizing: auto;
        font-style: normal;
      }
    </style>
  </head>
  <body
    class="bg-[url('Mask.png')] bg-cover bg-center bg-no-repeat min-h-screen font-sans"
  >
    <div class="flex">
      <!-- Sidebar -->
      <aside
        class="w-1/5 shadow-lg flex flex-col justify-between h-screen sticky top-0"
      >
        <div class="p-6">
          <!-- Logo -->
          <div class="text-2xl font-bold text-purple-600 mb-10">
            <img
              src="assets/img/background/logo.png"
              alt="Admin Dashboard Logo"
            />
          </div>

          <!-- Menu Links -->
          <nav class="space-y-6">
            <a
              href="admin-dashboard.php"
              class="flex items-center space-x-4 "
            >
              <img
                src="assets/img/background/dashboard-active.png"
                width="20px"
                alt="Dashboard Icon"
              />
              <span>Dashboard</span>
            </a>
            <a href="admin-contest.php" class="flex items-center space-x-4">
              <img
                src="assets/img/background/contests.png"
                width="20px"
                alt="Contests Icon"
              />
              <span>Contests</span>
            </a>
            <a href="ap.php" class="flex items-center space-x-4">
              <img
                src="assets/img/background/problem-sets.png"
                width="20px"
                alt="Problem Sets Icon"
              />
              <span>Problem Sets</span>
            </a>
          </nav>
        </div>
        <div class="p-6 space-y-6">
          <!-- Bottom Links -->
          <a href="#" class="flex items-center space-x-4">
            <img
              src="assets/img/background/setting.png"
              width="20px"
              alt="Settings Icon"
            />
            <span>Settings</span>
          </a>
          <a href="#" class="flex items-center space-x-4">
            <img
              src="assets/img/background/logout.png"
              width="20px"
              alt="Logout Icon"
            />
            <span>Log Out</span>
          </a>
        </div>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
          <h1 class="text-2xl font-bold">Contest Details</h1>
        </header>

        <!-- Contest Details Form -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
          <h2 class="text-xl font-semibold text-purple-600 mb-4">
            Edit Contest Details
          </h2>
          <form id="editContestForm">
                <div class="grid grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label for="contestName" class="block text-gray-600 mb-2">Contest Name</label>
                        <input type="text" id="contestName" class="w-full border border-gray-300 rounded-lg p-2" required />
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-600 mb-2">Description</label>
                        <textarea id="description" class="w-full border border-gray-300 rounded-lg p-2" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="bannerUrl" class="block text-gray-600 mb-2">Banner URL</label>
                        <input type="text" id="bannerUrl" class="w-full border border-gray-300 rounded-lg p-2" required />
                    </div>
                    <div class="mb-4">
                        <label for="registrationStart" class="block text-gray-600 mb-2">Registration Start</label>
                        <input type="datetime-local" id="registrationStart" class="w-full border border-gray-300 rounded-lg p-2" required />
                    </div>
                    <div class="mb-4">
                        <label for="registrationEnd" class="block text-gray-600 mb-2">Registration End</label>
                        <input type="datetime-local" id="registrationEnd" class="w-full border border-gray-300 rounded-lg p-2" required />
                    </div>
                    <div class="mb-4">
                        <label for="startTime" class="block text-gray-600 mb-2">Start Time</label>
                        <input type="datetime-local" id="startTime" class="w-full border border-gray-300 rounded-lg p-2" required />
                    </div>
                    <div class="mb-4">
                        <label for="endTime" class="block text-gray-600 mb-2">End Time</label>
                        <input type="datetime-local" id="endTime" class="w-full border border-gray-300 rounded-lg p-2" required />
                    </div>
                    <div class="mb-4">
                        <label for="contestantsNumber" class="block text-gray-600 mb-2">Contestants</label>
                        <input type="number" id="contestantsNumber" class="w-full border border-gray-300 rounded-lg p-2" required />
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-4">
                    <button type="button" id="publishBtn" class="px-4 py-2 bg-green-500 text-white rounded-lg">Publish</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Save</button>
                    <button type="button" id="deleteBtn" class="px-4 py-2 bg-red-500 text-white rounded-lg">Delete</button>
                </div>
            </form>
        </div>

        <!-- Problems Section -->
<div class="bg-white shadow-lg rounded-lg p-6 mb-6">
  <h2 class="text-xl font-semibold text-purple-600 mb-4">Problems</h2>
  <div class="flex justify-between items-center mb-4">
    <h3 class="text-lg font-bold">Added Problems</h3>
    <button
      id="createProblemBtn"
      class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg"
    >
      Add Problem
    </button>
  </div>
  <table class="w-full text-left border-collapse">
    <thead>
      <tr class="bg-gray-100">
        <th class="p-4 border">Problem Title</th>
        <th class="p-4 border">Difficulty</th>
        <th class="p-4 border">Tags</th>
        <th class="p-4 border">Actions</th>
      </tr>
    </thead>
    <tbody id="problemsTableBody">
      <!-- Dynamically populated rows -->
    </tbody>
  </table>
</div>

<!-- Add Test Case Modal -->
<div
  id="addTestCaseModal"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <div class="bg-white rounded-lg shadow-lg w-1/2 max-h-[90vh] overflow-y-auto p-6">
    <h2 class="text-xl font-semibold text-purple-600 mb-4">Add Test Case</h2>
    <form id="testCaseForm">
      <div class="mb-4">
        <label for="sampleInput" class="block text-gray-600 mb-2">Sample Input</label>
        <textarea
          id="sampleInput"
          class="w-full border border-gray-300 rounded-lg p-2"
          placeholder="Enter sample input"
        ></textarea>
      </div>
      <div class="mb-4">
        <label for="sampleOutput" class="block text-gray-600 mb-2">Sample Output</label>
        <textarea
          id="sampleOutput"
          class="w-full border border-gray-300 rounded-lg p-2"
          placeholder="Enter sample output"
        ></textarea>
      </div>
      <h3 class="text-lg font-semibold mb-2">Previously Added Test Cases:</h3>
      <ul id="testCaseList" class="list-disc pl-5 mb-4">
        <!-- Dynamically populated test cases -->
        <li id="noTestCasesMessage">No test cases added yet.</li>
      </ul>
      <div class="flex justify-end space-x-4">
        <button
          type="button"
          id="cancelTestCaseModal"
          class="px-4 py-2 border border-gray-300 rounded-lg"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg"
        >
          Add Test Case
        </button>
      </div>
    </form>
  </div>
</div>

<script>

document.addEventListener("DOMContentLoaded", () => {
  const contestId = new URLSearchParams(window.location.search).get("id");
  const problemsTableBody = document.getElementById("problemsTableBody");
  const addTestCaseModal = document.getElementById("addTestCaseModal");
  const cancelTestCaseModal = document.getElementById("cancelTestCaseModal");
  const testCaseList = document.getElementById("testCaseList");
  const noTestCasesMessage = document.getElementById("noTestCasesMessage");

 // Fetch problems from backend
 fetch(`backend/fetch_problems.php?contestId=${contestId}`)
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(problems => {
      problemsTableBody.innerHTML = ""; // Clear the table before populating
      if (problems.length === 0) {
        const emptyRow = document.createElement("tr");
        emptyRow.innerHTML = `
          <td colspan="4" class="p-4 border text-center text-gray-500">No problems added yet.</td>
        `;
        problemsTableBody.appendChild(emptyRow);
        return;
      }

      problems.forEach(problem => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td class="p-4 border">${problem.problem_title}</td>
          <td class="p-4 border">${problem.difficulty_level}</td>
          <td class="p-4 border">${problem.tags}</td>
          <td class="p-4 border">
          <button class="px-4 py-2 bg-blue-500 text-white rounded-lg" 
    onclick="openTestCaseModal(${problem.problem_id}, ${contestId})">
    Add Test Case
</button>

            <button class="px-4 py-2 bg-red-500 text-white rounded-lg" onclick="deleteProblem(${problem.problem_id})">
              Delete
            </button>
          </td>
        `;
        problemsTableBody.appendChild(row);
      });
    })
    .catch(error => console.error("Error fetching problems:", error));
});
  // Open test case modal
  window.openTestCaseModal = (problemId, contestId) => {
    const addTestCaseModal = document.getElementById("addTestCaseModal");
    const testCaseList = document.getElementById("testCaseList");
    const noTestCasesMessage = document.getElementById("noTestCasesMessage");

    // Show the modal and attach IDs
    addTestCaseModal.classList.remove("hidden");
    addTestCaseModal.dataset.problemId = problemId;
    addTestCaseModal.dataset.contestId = contestId;

    // Fetch existing test cases
    fetch(`backend/fetch_test_cases.php?problemId=${problemId}&contestId=${contestId}`)
        .then(response => response.json())
        .then(testCases => {
            testCaseList.innerHTML = ""; // Clear the previous list

            if (testCases.length === 0) {
                noTestCasesMessage.style.display = "block"; // Show "No test cases" message
            } else {
                noTestCasesMessage.style.display = "none"; // Hide the message

                testCases.forEach(testCase => {
                    const listItem = document.createElement("li");
                    listItem.textContent = `Input: ${testCase.sample_input}, Output: ${testCase.sample_output}`;
                    testCaseList.appendChild(listItem);
                });
            }
        })
        .catch(error => {
            console.error("Error fetching test cases:", error);
            noTestCasesMessage.style.display = "block"; // Show the message in case of error
        });
};


  // Close test case modal
  cancelTestCaseModal.addEventListener("click", () => {
    addTestCaseModal.classList.add("hidden");
  });

  // Handle test case form submission
  document.getElementById("testCaseForm").addEventListener("submit", e => {
    e.preventDefault();
    const problemId = addTestCaseModal.dataset.problemId; // Ensure the modal has the `problemId` data attribute set.
    const contestId = addTestCaseModal.dataset.contestId; // Ensure the modal has the `contestId` data attribute set.
    const sampleInput = document.getElementById("sampleInput").value.trim();
    const sampleOutput = document.getElementById("sampleOutput").value.trim();
    console.log("Problem ID:", problemId);
console.log("Contest ID:", contestId);
console.log("Sample Input:", sampleInput);
console.log("Sample Output:", sampleOutput);

    if (!problemId || !contestId || !sampleInput || !sampleOutput) {
      console.log(problemId,contestId,sampleInput,sampleOutput);
        alert("All fields are required.");
        return;
    }

    fetch("backend/add_test_case.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            problemId: parseInt(problemId),
            contestId: parseInt(contestId),
            sample_input: sampleInput,
            sample_output: sampleOutput
        }),
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                document.getElementById("sampleInput").value = ""; // Clear the input field
                document.getElementById("sampleOutput").value = ""; // Clear the output field
                openTestCaseModal(problemId); // Refresh test cases
            }
        })
        .catch(error => console.error("Error adding test case:", error));
});

</script>

      </main>
    </div>

    <div
  id="addProblemModal"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <div
    class="bg-white rounded-lg shadow-lg w-2/3 max-h-[90vh] overflow-y-auto p-6"
  >
    <h2 class="text-xl font-semibold text-purple-600 mb-4">
      Add New Problem
    </h2>
    <form id="problemForm">
      <div class="grid grid-cols-2 gap-6">
        <div class="mb-4">
          <label for="problemTitle" class="block text-gray-600 mb-2"
            >Problem Title</label
          >
          <input
            type="text"
            id="problemTitle"
            class="w-full border border-gray-300 rounded-lg p-2"
            placeholder="Enter problem title"
          />
        </div>
        <div class="mb-4">
          <label for="description" class="block text-gray-600 mb-2"
            >Description</label
          >
          <textarea
            id="description"
            class="w-full border border-gray-300 rounded-lg p-2"
            placeholder="Enter problem description"
          ></textarea>
        </div>
        <div class="mb-4">
          <label for="difficulty" class="block text-gray-600 mb-2"
            >Difficulty Level</label
          >
          <select
            id="difficulty"
            class="w-full border border-gray-300 rounded-lg p-2"
          >
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
          </select>
        </div>
        <div class="mb-4">
          <label for="problemTags" class="block text-gray-600 mb-2"
            >Problem Tags</label
          >
          <input
            type="text"
            id="problemTags"
            class="w-full border border-gray-300 rounded-lg p-2"
            placeholder="Enter Tags e.g. Array, Graph etc"
          />
        </div>
        <div class="mb-4">
          <label for="inputFormat" class="block text-gray-600 mb-2"
            >Input Format</label
          >
          <textarea
            id="inputFormat"
            class="w-full border border-gray-300 rounded-lg p-2"
            placeholder="Enter input format"
          ></textarea>
        </div>
        <div class="mb-4">
          <label for="outputFormat" class="block text-gray-600 mb-2"
            >Output Format</label
          >
          <textarea
            id="outputFormat"
            class="w-full border border-gray-300 rounded-lg p-2"
            placeholder="Enter output format"
          ></textarea>
        </div>
      </div>
      <!-- Buttons Container -->
      <div class="flex justify-end space-x-4 mt-4">
        <button
          type="button"
          id="cancelProblemModal"
          class="px-4 py-2 border border-gray-300 rounded-lg"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg"
        >
          Add Problem
        </button>
      </div>
    </form>
  </div>
</div>

<script>

function deleteProblem(problemId) {
    if (!confirm("Are you sure you want to delete this problem? This will also delete all associated test cases.")) {
        return;
    }

    fetch("backend/delete_problem.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ problemId })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            location.reload(); // Reload the page to update the table
        }
    })
    .catch(error => console.error("Error deleting problem:", error));
}

</script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const contestId = new URLSearchParams(window.location.search).get("id");
        const createProblemBtn = document.getElementById("createProblemBtn");
        const addProblemModal = document.getElementById("addProblemModal");
        const cancelProblemModal = document.getElementById("cancelProblemModal");
        const problemForm = document.getElementById("problemForm");

        // Open and close modal
        createProblemBtn.addEventListener("click", () => {
            addProblemModal.classList.remove("hidden");
        });

        cancelProblemModal.addEventListener("click", () => {
            addProblemModal.classList.add("hidden");
        });

        // Submit problem form
        problemForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append('contestId', contestId);
            formData.append('problemTitle', document.getElementById('problemTitle').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('difficulty', document.getElementById('difficulty').value);
            formData.append('problemTags', document.getElementById('problemTags').value);
            formData.append('inputFormat', document.getElementById('inputFormat').value);
            formData.append('outputFormat', document.getElementById('outputFormat').value);

            fetch('backend/add_problem.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred.');
                });
        });
    });
</script>



  <script>

     document.addEventListener("DOMContentLoaded", function () {
        const contestId = new URLSearchParams(window.location.search).get("id");
        const editForm = document.getElementById("editContestForm");
        const publishBtn = document.getElementById("publishBtn");
        const deleteBtn = document.getElementById("deleteBtn");

        // Fetch contest details
        fetch(`backend/fetch_contest.php?id=${contestId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById("contestName").value = data.contest_name;
                document.getElementById("description").value = data.description;
                document.getElementById("bannerUrl").value = data.banner;
                document.getElementById("registrationStart").value = data.registration_start_time;
                document.getElementById("registrationEnd").value = data.registration_end_time;
                document.getElementById("startTime").value = data.start_time;
                document.getElementById("endTime").value = data.end_time;
                document.getElementById("contestantsNumber").value = data.contestants;
            });

        // Save changes
        editForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent default form submission

    // Create FormData object
    const formData = new FormData();
    formData.append("id", contestId);
    formData.append("contestName", document.getElementById("contestName").value);
    formData.append("description", document.getElementById("description").value);
    formData.append("bannerUrl", document.getElementById("bannerUrl").value);
    formData.append("registrationStart", document.getElementById("registrationStart").value);
    formData.append("registrationEnd", document.getElementById("registrationEnd").value);
    formData.append("startTime", document.getElementById("startTime").value);
    formData.append("endTime", document.getElementById("endTime").value);
    formData.append("contestantsNumber", document.getElementById("contestantsNumber").value);

    // Send data to update_contest.php
    fetch("backend/update_contest.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => {
            console.log("Raw Response:", response);
            return response.json();
        })
        .then((data) => {
            console.log("JSON Data:", data);
            if (data.success) {
                alert("Contest updated successfully!");
                window.location.reload(); // Refresh the page on success
            } else {
                alert("Failed to update contest: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An unexpected error occurred.");
        });
});


        // Publish contest
        publishBtn.addEventListener("click", function () {
    fetch(`backend/publish_contest.php?id=${contestId}`, {
        method: "POST",
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                window.location.href = "admin-contest.php"; // Redirect to admin-contest.php
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An unexpected error occurred.");
        });
});


        // Delete contest
        deleteBtn.addEventListener("click", function () {
            if (confirm("Are you sure you want to delete this contest?")) {
                fetch(`backend/delete_contest.php?id=${contestId}`, {
                    method: "POST",
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        if (data.success) {
                            window.location.href = "admin-contest.php";
                        }
                    });
            }
        });
    });
  </script>



  </body>
</html>
