<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="assets/img/background/fav-logo.png" />
    <title>CodeCraft Dashboard</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");

        * {
            font-family: "Syne", serif;
            font-optical-sizing: auto;
            font-style: normal;
        }
    </style>
</head>
<body class="bg-[url('Mask.png')] bg-cover bg-center bg-no-repeat min-h-screen font-sans">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-1/5 shadow-lg flex flex-col justify-between h-screen sticky top-0">
            <div class="p-6">
                <div class="text-2xl font-bold text-purple-600 mb-10">
                    <img src="assets/img/background/logo.png" alt="Dashboard logo" />
                </div>
                <nav class="space-y-6">
                    <a href="dashboard.php" class="flex items-center space-x-4">
                        <img src="assets/img/background/document.png" width="20px" alt="Dashboard Icon" />
                        <span>Dashboard</span>
                    </a>
                    <a href="test-list.php" class="flex items-center space-x-4">
                        <img src="assets/img/background/test.png" width="20px" alt="Tests Icon" />
                        <span>Tests</span>
                    </a>
                    <a href="problems.php" class="flex items-center space-x-4 text-purple-600">
                        <img src="assets/img/background/document-active.png" width="20px" alt="Courses Icon" />
                        <span>Problem Sets</span>
                    </a>
                    <a href="profile-coder.php" class="flex items-center space-x-4">
                        <img src="assets/img/background/dp.png" width="20px" alt="Profile Icon" />
                        <span>Profile</span>
                    </a>
                    <a href="leaderboard.php" class="flex items-center space-x-4">
                        <img src="assets/img/background/leaderboard.png" width="20px" alt="Leaderboard Icon" />
                        <span>Leaderboard</span>
                    </a>
                </nav>
            </div>
            <div class="p-6 space-y-6">
          <!-- Bottom Links -->
          <a href="settings.php" class="flex items-center space-x-4">
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
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold">Problem Sets</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative flex items-center">
                        <img src="assets/img/background/search.png" alt="Search Icon" class="absolute left-3 w-4 h-4" />
                        <input type="text" id="search-input" placeholder="Search problems" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full" />
                    </div>
                    <img src="assets/img/background/Bell.png" width="20px" alt="Notification Icon" class="cursor-pointer" />
                    <img src="https://via.placeholder.com/40" alt="Profile Icon" class="rounded-full cursor-pointer" />
                </div>
            </header>

            <!-- Filters Section -->
            <div class="border rounded-lg p-4 space-y-4 bg-white shadow-md">
                <div class="flex space-x-4">
                    <select id="sort-options" class="border rounded-lg px-4 py-2">
                        <option value="all">Show All</option>
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>

                    <!-- Tag Filters -->
                    <select id="tag-filter" class="border rounded-lg px-4 py-2">
                        <option value="all">All Tags</option>
                        <option value="array">Array</option>
                        <option value="graph">Graph</option>
                        <option value="tree">Tree</option>
                        <option value="dynamic-programming">Dynamic Programming</option>
                        <option value="math">Math</option>
                    </select>
                </div>
            </div>

            <!-- Problems Table -->
            <div class="overflow-x-auto mt-8">
                <table class="min-w-full table-auto border-collapse border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Serial</th>
                            <th class="border px-4 py-2">Difficulty</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Questions</th>
                            <th class="border px-4 py-2">Tags</th>
                            <th class="border px-4 py-2">Attempt</th>
                        </tr>
                    </thead>
                    <tbody id="problem-table-body">
                        <!-- Problems will be dynamically loaded here -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div id="pagination" class="flex justify-center mt-6 space-x-4"></div>
        </main>
    </div>

    <script>
        let currentPage = 1;
        let totalPages = 1;

        async function fetchProblems() {
            const searchQuery = document.getElementById("search-input").value;
            const difficultyFilter = document.getElementById("sort-options").value;
            const tagFilter = document.getElementById("tag-filter").value;

            const response = await fetch(`backend/up/fetch_problems.php?page=${currentPage}&search=${searchQuery}&difficulty=${difficultyFilter}&tag=${tagFilter}`);
            const data = await response.json();

            const problemTableBody = document.getElementById("problem-table-body");
            problemTableBody.innerHTML = "";

            if (data.problems.length === 0) {
                problemTableBody.innerHTML = `<tr><td colspan="5" class="text-center text-gray-500 py-4">No problems found</td></tr>`;
                return;
            }

            data.problems.forEach((problem, index) => {
                problemTableBody.innerHTML += `
                    <tr>
                        <td class="border px-4 py-2">${index + 1 + (currentPage - 1) * 10}</td>
                        <td class="border px-4 py-2">${problem.difficulty_level}</td>
                        <td class="border px-4 py-2"><span class="text-yellow-500">No Attempt</span></td>
                        <td class="border px-4 py-2">${problem.problem_title}</td>
                        <td class="border px-4 py-2">${problem.tags}</td>
                        <td class="border px-4 py-2 text-center">
                <button onclick="goToCompiler(${problem.problem_id})">
                    <img src="assets/img/code.png" width="20px" alt="Code Icon" class="cursor-pointer hover:scale-110 transition-transform" />
                </button>
            </td>
                    </tr>
                `;
            });

            totalPages = Math.ceil(data.total / data.limit);
            updatePagination();
        }

        function updatePagination() {
            const paginationContainer = document.getElementById("pagination");
            paginationContainer.innerHTML = "";

            if (totalPages <= 1) return;

            for (let i = 1; i <= totalPages; i++) {
                paginationContainer.innerHTML += `<button onclick="changePage(${i})" class="w-10 h-10 bg-gray-200 rounded-full ${i === currentPage ? 'bg-purple-500 text-white' : ''}">${i}</button>`;
            }
        }

        function changePage(page) {
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            fetchProblems();
        }

        document.getElementById("search-input").addEventListener("input", fetchProblems);
        document.getElementById("sort-options").addEventListener("change", fetchProblems);
        document.getElementById("tag-filter").addEventListener("change", fetchProblems);

        document.addEventListener("DOMContentLoaded", fetchProblems);



        // Function to Redirect to Compiler
function goToCompiler(problemId) {
    window.location.href = `p-compiler.php?problem_id=${problemId}`;
}
    </script>
</body>
</html>
