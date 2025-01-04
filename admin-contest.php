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
    <title>Admin - Contests</title>
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
                <a href="admin-contest.php" class="flex items-center space-x-4 text-purple-600">
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
            <h1 class="text-2xl font-bold">Contests</h1>
            <button
                id="createContestBtn"
                class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full"
            >
                Create New Contest
            </button>
        </header>

        <!-- Newly Added Contests -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-purple-600 mb-4">
                Newly Added Contests (Not Published)
            </h2>
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-4 border">Banner</th>
                    <th class="p-4 border">Contest Name</th>
                    <th class="p-4 border">Description</th>
                    <th class="p-4 border">Start Time</th>
                    <th class="p-4 border">End Time</th>
                    <th class="p-4 border">Actions</th>
                </tr>
                </thead>
                <tbody id="newContestsTableBody">
                <!-- Dynamic content will be added here -->
                </tbody>
            </table>
            <div id="pagination" class="flex justify-center space-x-2 mt-4"></div>
        </div>


        <div class="bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-xl font-semibold text-purple-600 mb-4">Published Contests</h2>

    <!-- Filter Section -->
    <div class="flex justify-between mb-4">
        <!-- Search Input -->
        <input type="text" id="searchInput" placeholder="Search by Contest Name..." 
            class="p-2 border border-gray-300 rounded-lg w-1/3"/>

        <!-- Filter Dropdown -->
        <select id="statusFilter" class="p-2 border border-gray-300 rounded-lg">
            <option value="all">All</option>
            <option value="upcoming">Upcoming</option>
            <option value="ongoing">Ongoing</option>
            <option value="previous">Previous</option>
        </select>
    </div>

    <!-- Contest Table -->
    <table class="w-full text-left border-collapse">
        <thead>
        <tr class="bg-gray-100">
            <th class="p-4 border">Banner</th>
            <th class="p-4 border">Contest Name</th>
            <th class="p-4 border">Description</th>
            <th class="p-4 border">Start Time</th>
            <th class="p-4 border">End Time</th>
        </tr>
        </thead>
        <tbody id="PublishedContestsTableBody">
            <!-- Dynamic content will be added here -->
        </tbody>
    </table>
    <div id="ContestPagination" class="flex justify-center space-x-2 mt-4"></div>
</div>



    </main>
</div>

<!-- Create Contest Modal -->
<div
    id="createContestModal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
    <div class="bg-white rounded-lg shadow-lg w-2/3 p-6">
        <h2 class="text-xl font-semibold text-purple-600 mb-4">
            Create New Contest
        </h2>
        <form id="createContestForm" action="backend/create_contest.php" method="POST">
            <div class="grid grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="contestName" class="block text-gray-600 mb-2">Contest Name</label>
                    <input
                        type="text"
                        id="contestName"
                        name="contestName"
                        class="w-full border border-gray-300 rounded-lg p-2"
                        placeholder="Enter contest name"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-600 mb-2">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        class="w-full border border-gray-300 rounded-lg p-2"
                        placeholder="Enter contest description"
                        required
                    ></textarea>
                </div>
                <div class="mb-4">
                    <label for="bannerUrl" class="block text-gray-600 mb-2">Banner URL</label>
                    <input
                        type="text"
                        id="bannerUrl"
                        name="bannerUrl"
                        class="w-full border border-gray-300 rounded-lg p-2"
                        placeholder="Enter image URL"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="contestantsNumber" class="block text-gray-600 mb-2">Number of Contestants</label>
                    <input
                        type="number"
                        id="contestantsNumber"
                        name="contestantsNumber"
                        class="w-full border border-gray-300 rounded-lg p-2"
                        placeholder="Enter number of contestants"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="registrationStart" class="block text-gray-600 mb-2">Registration Start Time</label>
                    <input
                        type="datetime-local"
                        id="registrationStart"
                        name="registrationStart"
                        class="w-full border border-gray-300 rounded-lg p-2"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="registrationEnd" class="block text-gray-600 mb-2">Registration End Time</label>
                    <input
                        type="datetime-local"
                        id="registrationEnd"
                        name="registrationEnd"
                        class="w-full border border-gray-300 rounded-lg p-2"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="startTime" class="block text-gray-600 mb-2">Contest Start Time</label>
                    <input
                        type="datetime-local"
                        id="startTime"
                        name="startTime"
                        class="w-full border border-gray-300 rounded-lg p-2"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="endTime" class="block text-gray-600 mb-2">Contest End Time</label>
                    <input
                        type="datetime-local"
                        id="endTime"
                        name="endTime"
                        class="w-full border border-gray-300 rounded-lg p-2"
                        required
                    />
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button
                    type="button"
                    id="cancelModal"
                    class="px-4 py-2 border border-gray-300 rounded-lg"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg"
                >
                    Create
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const publishedTableBody = document.getElementById("PublishedContestsTableBody");
    const contestPagination = document.getElementById("ContestPagination");
    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");

    function fetchPublishedContests(page = 1) {
        const searchQuery = searchInput.value.trim();
        const status = statusFilter.value;

        fetch(`backend/fetch_published_contests.php?page=${page}&search=${searchQuery}&status=${status}`)
            .then((response) => response.json())
            .then((data) => {
                publishedTableBody.innerHTML = ""; // Clear table

                if (data.contests.length === 0) {
                    publishedTableBody.innerHTML = `
                        <tr>
                            <td colspan="5" class="p-4 border text-center text-gray-500">
                                No contests found.
                            </td>
                        </tr>`;
                    return;
                }

                data.contests.forEach((contest) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td class="p-4 border">
                            <img src="${contest.banner || 'https://via.placeholder.com/150'}" 
                                alt="Contest Banner" 
                                class="rounded-lg w-20 h-20" />
                        </td>
                        <td class="p-4 border">${contest.contest_name}</td>
                        <td class="p-4 border">${contest.description}</td>
                        <td class="p-4 border">${contest.start_time}</td>
                        <td class="p-4 border">${contest.end_time}</td>
                    `;
                    publishedTableBody.appendChild(row);
                });

                // Pagination
                contestPagination.innerHTML = ""; // Clear pagination
                for (let i = 1; i <= data.totalPages; i++) {
                    const pageLink = document.createElement("button");
                    pageLink.className = `px-3 py-1 border rounded-lg ${
                        i === data.currentPage ? "bg-blue-500 text-white" : "bg-white text-black"
                    }`;
                    pageLink.textContent = i;
                    pageLink.onclick = () => fetchPublishedContests(i);
                    contestPagination.appendChild(pageLink);
                }
            })
            .catch((error) => console.error("Error fetching published contests:", error));
    }

    // Event listeners for filtering
    searchInput.addEventListener("input", () => fetchPublishedContests());
    statusFilter.addEventListener("change", () => fetchPublishedContests());

    // Initial fetch
    fetchPublishedContests();
});
</script>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const createContestBtn = document.getElementById("createContestBtn");
        const createContestModal = document.getElementById("createContestModal");
        const cancelModal = document.getElementById("cancelModal");

        // Show/hide modal
        createContestBtn.addEventListener("click", () => {
            createContestModal.classList.remove("hidden");
        });

        cancelModal.addEventListener("click", () => {
            createContestModal.classList.add("hidden");
        });

        // Fetch contests
        const tableBody = document.getElementById("newContestsTableBody");
        const pagination = document.getElementById("pagination");

        function fetchContests(page = 1) {
            fetch(`backend/fetch_unpublished_contests.php?page=${page}`)
                .then((response) => response.json())
                .then((data) => {
                    tableBody.innerHTML = ""; // Clear table
                    data.contests.forEach((contest) => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td class="p-4 border">
                                <img src="${contest.banner || 'https://via.placeholder.com/150'}" alt="Contest Banner" class="rounded-lg w-20 h-20" />
                            </td>
                            <td class="p-4 border">${contest.contest_name}</td>
                            <td class="p-4 border">${contest.description}</td>
                            <td class="p-4 border">${contest.start_time}</td>
                            <td class="p-4 border">${contest.end_time}</td>
                            <td class="p-4 border">
                                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg" onclick="editContest(${contest.contest_id})">Edit</button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });

                    pagination.innerHTML = ""; // Clear pagination
                    for (let i = 1; i <= data.totalPages; i++) {
                        const pageLink = document.createElement("button");
                        pageLink.className = `px-3 py-1 border rounded-lg ${
                            i === data.currentPage ? "bg-blue-500 text-white" : "bg-white text-black"
                        }`;
                        pageLink.textContent = i;
                        pageLink.onclick = () => fetchContests(i);
                        pagination.appendChild(pageLink);
                    }
                });
        }

        // Redirect to edit page
        window.editContest = function (contestId) {
            window.location.href = `admin-edit-contest.php?id=${contestId}`;
        };

        // Initial fetch
        fetchContests();
    });
</script>
</body>
</html>
