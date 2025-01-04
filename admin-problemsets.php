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
    <title>Admin - Problem Sets</title>
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
              class="flex items-center space-x-4"
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
            <a href="ap.php" class="flex items-center space-x-4 text-purple-600">
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
          <a href="backend/logout.php" class="flex items-center space-x-4">
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
          <h1 class="text-2xl font-bold">Problem Sets</h1>
          <button
            id="createProblemBtn"
            class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full"
          >
            Add New Problem
          </button>
        </header>

        <!-- Filters and Search -->
        <div class="flex justify-between items-center mb-6">
          <div class="flex items-center space-x-4">
            <select
              id="filterDifficulty"
              class="border border-gray-300 rounded-lg p-2"
            >
              <option value="all">All Levels</option>
              <option value="easy">Easy</option>
              <option value="medium">Medium</option>
              <option value="hard">Hard</option>
            </select>
          </div>
          <div class="relative flex items-center">
            <img
              src="assets/img/background/search.png"
              alt="Search Icon"
              class="absolute left-3 w-4 h-4"
            />
            <input
              type="text"
              id="searchBar"
              placeholder="Search problems"
              class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full"
            />
          </div>
        </div>

        <!-- Problem Sets Table -->
        <div class="bg-white shadow-lg rounded-lg p-6">
          <h2 class="text-xl font-semibold text-purple-600 mb-4">
            Problem Sets
          </h2>
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-100">
                <th class="p-4 border">Title</th>
                <th class="p-4 border">Description</th>
                <th class="p-4 border">Difficulty</th>
                <th class="p-4 border">Tags</th>
                <th class="p-4 border">Actions</th>
              </tr>
            </thead>
            <tbody id="problemTableBody">
              
            </tbody>
          </table>
        </div>
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
            <label for="tags" class="block text-gray-600 mb-2"
                >Tags</label
              >
              <textarea
                id="tags"
                class="w-full border border-gray-300 rounded-lg p-2"
                placeholder="Tags e.g. Array, Graph"
              ></textarea>

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

<!-- Add Test Case Modal -->
<div id="addTestCaseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/2 max-h-[90vh] overflow-y-auto p-6">
        <h2 class="text-xl font-semibold text-purple-600 mb-4">Add Test Case</h2>
        <form id="testCaseForm">
            <input type="hidden" id="testCaseProblemId">
            <div class="mb-4">
                <label for="sampleInput" class="block text-gray-600 mb-2">Sample Input</label>
                <textarea id="sampleInput" class="w-full border border-gray-300 rounded-lg p-2" required></textarea>
            </div>
            <div class="mb-4">
                <label for="sampleOutput" class="block text-gray-600 mb-2">Sample Output</label>
                <textarea id="sampleOutput" class="w-full border border-gray-300 rounded-lg p-2" required></textarea>
            </div>
            <h3 class="text-lg font-semibold mb-2">Previously Added Test Cases:</h3>
            <ul id="testCaseList" class="list-disc pl-5 mb-4">
                <li id="noTestCasesMessage" class="text-gray-500 italic">No test cases added yet.</li>
            </ul>
            <div class="flex justify-end space-x-4">
                <button type="button" id="cancelTestCaseModal" class="px-4 py-2 border border-gray-300 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Add Test Case</button>
            </div>
        </form>
    </div>
</div>



<!-- Edit Problem Modal -->
<div id="editProblemModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-2/3 max-h-[90vh] overflow-y-auto p-6">
        <h2 class="text-xl font-semibold text-purple-600 mb-4">Edit Problem</h2>
        <form id="editProblemForm">
            <input type="hidden" id="editProblemId">
            <div class="grid grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="editProblemTitle" class="block text-gray-600 mb-2">Problem Title</label>
                    <input type="text" id="editProblemTitle" class="w-full border border-gray-300 rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="editDescription" class="block text-gray-600 mb-2">Description</label>
                    <textarea id="editDescription" class="w-full border border-gray-300 rounded-lg p-2" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="editDifficulty" class="block text-gray-600 mb-2">Difficulty Level</label>
                    <select id="editDifficulty" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="editTags" class="block text-gray-600 mb-2">Tags</label>
                    <textarea id="editTags" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
                </div>
                <div class="mb-4">
                    <label for="editInputFormat" class="block text-gray-600 mb-2">Input Format</label>
                    <textarea id="editInputFormat" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
                </div>
                <div class="mb-4">
                    <label for="editOutputFormat" class="block text-gray-600 mb-2">Output Format</label>
                    <textarea id="editOutputFormat" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" id="cancelEditModal" class="px-4 py-2 border border-gray-300 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg">Update</button>
            </div>
        </form>
    </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const editProblemModal = document.getElementById("editProblemModal");
    const cancelEditModal = document.getElementById("cancelEditModal");
    const editProblemForm = document.getElementById("editProblemForm");

    // Function to open the Edit Problem Modal and populate data
    window.openEditModal = function (problemId) {
        editProblemModal.classList.remove("hidden");

        // Fetch problem details and populate fields
        fetch(`backend/ap/fetch_problem_details.php?problemId=${problemId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById("editProblemId").value = problemId;
                document.getElementById("editProblemTitle").value = data.problem_title;
                document.getElementById("editDescription").value = data.description;
                document.getElementById("editDifficulty").value = data.difficulty_level;
                document.getElementById("editTags").value = data.tags;
                document.getElementById("editInputFormat").value = data.input_format;
                document.getElementById("editOutputFormat").value = data.output_format;
            })
            .catch(error => console.error("Error fetching problem details:", error));
    };

    // Close modal on cancel button click
    cancelEditModal.addEventListener("click", () => {
        editProblemModal.classList.add("hidden");
    });

    // Handle problem update
    editProblemForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const problemId = document.getElementById("editProblemId").value;
        const problemTitle = document.getElementById("editProblemTitle").value.trim();
        const description = document.getElementById("editDescription").value.trim();
        const difficulty = document.getElementById("editDifficulty").value;
        const tags = document.getElementById("editTags").value.trim();
        const inputFormat = document.getElementById("editInputFormat").value.trim();
        const outputFormat = document.getElementById("editOutputFormat").value.trim();

        if (!problemTitle || !description || !difficulty || !tags || !inputFormat || !outputFormat) {
            alert("All fields are required.");
            return;
        }

        fetch("backend/ap/update_problem.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                problemId,
                problemTitle,
                description,
                difficulty,
                tags,
                inputFormat,
                outputFormat,
            }),
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    editProblemModal.classList.add("hidden");
                    window.location.reload(); // Refresh the page to show updated problem details
                }
            })
            .catch(error => console.error("Error updating problem:", error));
    });
});

</script>

<script>
    // Handle Test Case Submission
    testCaseForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const problemId = testCaseProblemId.value;
        const sampleInput = document.getElementById("sampleInput").value.trim();
        const sampleOutput = document.getElementById("sampleOutput").value.trim();

        if (!problemId || !sampleInput || !sampleOutput) {
            alert("All fields are required.");
            return;
        }

        fetch("backend/ap/add_test_case.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                problemId,
                sampleInput,
                sampleOutput
            }),
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    document.getElementById("sampleInput").value = "";
                    document.getElementById("sampleOutput").value = "";
                    testCaseModal.classList.add("hidden");
                    fetchTestCases(problemId); // Refresh test cases
                }
            })
            .catch(error => console.error("Error adding test case:", error));
    });
</script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
    const problemTableBody = document.getElementById("problemTableBody");

    function fetchProblems() {
        fetch("backend/ap/fetch_problems.php")
            .then(response => response.json())
            .then(data => {
                problemTableBody.innerHTML = ""; // Clear existing rows

                if (data.length === 0) {
                    problemTableBody.innerHTML = `
                        <tr>
                            <td colspan="4" class="p-4 border text-center text-gray-500">
                                No problems found.
                            </td>
                        </tr>`;
                    return;
                }

                data.forEach(problem => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                    <td class="p-4 border">${problem.problem_title}</td>
                        <td class="p-4 border">${problem.description}</td>
                        <td class="p-4 border">${problem.difficulty_level}</td>
                        <td class="p-4 border">${problem.tags}</td>
                        <td class="p-4 border gap-5">
                            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg" 
                                onclick="openTestCaseModal(${problem.problem_id})">
                                Add Test Case
                            </button>
                            <button class="px-4 py-2 bg-green-500 text-white rounded-lg" 
                                onclick="openEditModal(${problem.problem_id})">
                                Edit
                            </button>
                        </td>
                       
                    `;
                    problemTableBody.appendChild(row);
                });
            })
            .catch(error => console.error("Error fetching problems:", error));
    }

    // Fetch problems on page load
    fetchProblems();

   // Function to open the Test Case Modal
window.openTestCaseModal = function (problemId) {
    const addTestCaseModal = document.getElementById("addTestCaseModal");
    const testCaseProblemId = document.getElementById("testCaseProblemId");
    const testCaseList = document.getElementById("testCaseList");
    const noTestCasesMessage = document.getElementById("noTestCasesMessage");
    if (!addTestCaseModal || !testCaseProblemId) {
        console.error("Error: Modal or Problem ID input not found.");
        return;
    }

    // Set modal visibility and problem ID
    addTestCaseModal.classList.remove("hidden");
    testCaseProblemId.value = problemId; // Correctly assign problem ID to the hidden input field

     // Fetch existing test cases
     fetch(`backend/ap/fetch_test_cases.php?problemId=${problemId}`)
        .then(response => response.json())
        .then(testCases => {
            testCaseList.innerHTML = ""; // Clear previous content

            if (testCases.length === 0) {
                noTestCasesMessage.style.display = "block";
            } else {
                noTestCasesMessage.style.display = "none";
                testCases.forEach(testCase => {
                    const listItem = document.createElement("li");
                    listItem.className = "border p-2 rounded-lg bg-gray-100";
                    listItem.textContent = `Input: ${testCase.sample_input}, Output: ${testCase.sample_output}`;
                    testCaseList.appendChild(listItem);
                });
            }
        })
        .catch(error => console.error("Error fetching test cases:", error));
};

    // Function to open the Edit Problem Modal
    window.openEditModal = function (problemId) {
        const editProblemModal = document.getElementById("editProblemModal");
        editProblemModal.classList.remove("hidden");

        // Fetch problem details and populate fields
        fetch(`backend/ap/fetch_problem_details.php?problemId=${problemId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById("editProblemId").value = problemId;
                document.getElementById("editProblemTitle").value = data.problem_title;
                document.getElementById("editDescription").value = data.description;
                document.getElementById("editDifficulty").value = data.difficulty_level;
                document.getElementById("editTags").value = data.tags;
                document.getElementById("editInputFormat").value = data.input_format;
                document.getElementById("editOutputFormat").value = data.output_format;
            })
            .catch(error => console.error("Error fetching problem details:", error));
    };

    // Close Modals
    document.getElementById("cancelTestCaseModal").addEventListener("click", () => {
        document.getElementById("addTestCaseModal").classList.add("hidden");
    });

    document.getElementById("cancelEditModal").addEventListener("click", () => {
        document.getElementById("editProblemModal").classList.add("hidden");
    });
});

    </script>

   <script>
    document.getElementById("problemForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent default form submission

    const contestId = new URLSearchParams(window.location.search).get("id");
    const problemTitle = document.getElementById("problemTitle").value.trim();
    const description = document.getElementById("description").value.trim();
    const difficulty = document.getElementById("difficulty").value;
    const tags = document.getElementById("tags").value.trim();
    const inputFormat = document.getElementById("inputFormat").value.trim();
    const outputFormat = document.getElementById("outputFormat").value.trim();

    if (!problemTitle || !description || !difficulty || !tags || !inputFormat || !outputFormat) {
        alert("All fields are required.");
        return;
    }

    const formData = new FormData();
    formData.append("problemTitle", problemTitle);
    formData.append("description", description);
    formData.append("difficulty", difficulty);
    formData.append("tags", tags);
    formData.append("inputFormat", inputFormat);
    formData.append("outputFormat", outputFormat);
    console.log("Submitting Form Data:", Object.fromEntries(formData));
    fetch("backend/ap/add_problem.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            document.getElementById("problemForm").reset();
            window.location.reload(); // Refresh the page on success
        }
    })
    .catch(error => console.error("Error adding problem:", error));
});

   </script>

    <script>
      const createProblemBtn = document.getElementById("createProblemBtn");
      const addProblemModal = document.getElementById("addProblemModal");
      const cancelProblemModal = document.getElementById("cancelProblemModal");
 

      // Open and close modal
      createProblemBtn.addEventListener("click", () => {
        addProblemModal.classList.remove("hidden");
      });

      cancelProblemModal.addEventListener("click", () => {
        addProblemModal.classList.add("hidden");
      });

 
    </script>
  </body>
</html>
