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
    <title>Contest Details - CodeCraft</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");

      * {
        font-family: "Syne", serif;
        font-optical-sizing: auto;
        font-style: normal;
      }

      /* Hide Y-axis scrollbar */
      .hide-scrollbar::-webkit-scrollbar {
        display: none;
      }
      .hide-scrollbar {
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Firefox */
      }
    </style>
  </head>
  <body
    class="bg-[url('Mask.png')] bg-cover bg-center bg-no-repeat min-h-screen font-sans"
  >
    <div class="flex">
      <!-- Sidebar -->
      

      <!-- Main Content -->
      <main class="flex-1 p-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
          <h1 class="text-2xl font-bold"></h1>
          <div class="flex items-center space-x-4">
            <div class="relative">
              <input
                type="text"
                placeholder="Search"
                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full focus:outline-none"
              />
              <img
                src="assets/img/background/search.png"
                alt="Search Icon"
                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-purple-600"
              />
            </div>
            <img
              src="assets/img/background/Bell.png"
              width="24px"
              alt="Notification Icon"
              class="cursor-pointer"
            />
            <img
              src="<?php echo htmlspecialchars($userProfilePicture); ?>"
              alt="Profile Icon"
              class="rounded-full cursor-pointer"
              width="40"
              height="40"
            />
          </div>
        </header>

        <!-- Main Content -->
        <div class="grid grid-cols-4 gap-6">
          <!-- Contest Details -->
          <div class="col-span-3 bg-white shadow-lg rounded-lg p-6" id="contest-details">
  <!-- Content will be dynamically populated here -->
</div>

          <!-- Leaderboard -->
          <div class="col-span-1 bg-white shadow-lg rounded-lg p-6 h-96 overflow-y-auto hide-scrollbar">
  <h3 class="text-lg font-bold text-purple-600 mb-4">Leaderboard</h3>
  <ul id="leaderboard-container" class="space-y-4">
    <!-- Leaderboard entries will be dynamically added here -->
  </ul>
</div>
        </div>

        <!-- Questions Table -->
        <div class="bg-white shadow-lg rounded-lg mt-8 p-6">
  <h3 class="text-lg font-bold text-purple-600 mb-4">Questions</h3>
  <table class="w-full text-left border-collapse">
    <thead>
      <tr>
        <th class="border-b py-2">#</th>
        <th class="border-b py-2">Question</th>
        <th class="border-b py-2">Tags</th>
        <th class="border-b py-2">Action</th>
      </tr>
    </thead>
    <tbody id="questions-tbody">
      <!-- Questions will be dynamically populated here -->
    </tbody>
  </table>
</div>



      </main>
    </div>

    <script>
  

    // Extract contest ID from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
  const contestId = urlParams.get("contest_id");

      // Function to fetch and populate contest details
  async function fetchContestDetails(contestId) {
    try {
      // Fetch contest details from the backend
      const response = await fetch(`backend/contest/details.php?contest_id=${contestId}`);
      if (!response.ok) {
        throw new Error("Failed to fetch contest details.");
      }

      const contest = await response.json();

      // Populate the contest details section
      const container = document.getElementById("contest-details");
      container.innerHTML = `
        <img
          src="${contest.banner || 'https://via.placeholder.com/150'}"
          alt="${contest.contest_name} Banner"
          class="rounded-lg mb-6 w-full h-64 object-cover"
        />
        <h2 class="text-3xl font-bold text-purple-600 mb-4">
          ${contest.contest_name}
        </h2>
        <p class="text-gray-700 mb-4">
          ${contest.description}
        </p>
        <p class="text-gray-700 mb-2">
          <strong>Ending Date:</strong> ${new Date(contest.end_time).toLocaleString()}
        </p>
        <p class="text-gray-700">
          <strong>Participants:</strong> ${contest.contestants}+
        </p>
      `;
    } catch (error) {
      console.error("Error fetching contest details:", error);
      const container = document.getElementById("contest-details");
      container.innerHTML = `
        <p class="text-red-500">Failed to load contest details. Please try again later.</p>
      `;
    }
  }


  // Fetch and populate the contest details
  if (contestId) {
    fetchContestDetails(contestId);
  } else {
    document.getElementById("contest-details").innerHTML = `
      <p class="text-red-500">No contest ID provided in the URL.</p>
    `;
  }
    </script>
    <script>


  // Function to fetch and populate questions
  async function fetchQuestions(contestId) {
    try {
      // Fetch questions from the backend
      const response = await fetch(`backend/contest/get-problems.php?contest_id=${contestId}`);
      if (!response.ok) {
        throw new Error("Failed to fetch questions.");
      }

      const questions = await response.json();

      // Get the table body element
      const tbody = document.getElementById("questions-tbody");
      tbody.innerHTML = ""; // Clear any existing content

      if (questions.length === 0) {
        tbody.innerHTML = `
          <tr>
            <td colspan="4" class="py-4 text-center text-gray-500">
              No questions available for this contest.
            </td>
          </tr>
        `;
        return;
      }

      // Populate the table with questions
      questions.forEach((question, index) => {
        const row = `
          <tr>
            <td class="border-b py-2">${index + 1}</td>
            <td class="border-b py-2">${question.problem_title}</td>
            <td class="border-b py-2">${question.tags}</td>
            <td class="border-b py-2">
              <button
                class="px-4 py-2 bg-purple-500 text-white rounded-lg"
                onclick="goToCompiler(${question.problem_id})"
              >
                Go to Compiler
              </button>
            </td>
          </tr>
        `;
        tbody.innerHTML += row;
      });
    } catch (error) {
      console.error("Error fetching questions:", error);
      const tbody = document.getElementById("questions-tbody");
      tbody.innerHTML = `
        <tr>
          <td colspan="4" class="py-4 text-center text-red-500">
            Failed to load questions. Please try again later.
          </td>
        </tr>
      `;
    }
  }

  // Function to redirect to the compiler for a specific problem
  function goToCompiler(problemId) {

    window.location.href = `contest-compiler.php?problem_id=${problemId}&contest_id=${contestId}`;
  }


  if (contestId) {
    fetchQuestions(contestId);
  } else {
    console.error("Contest ID is missing from the URL.");
  }


  if (contestId) {
    fetchLeaderboard(contestId);
  } else {
    console.error("Contest ID is missing in the URL.");
  }



  async function fetchLeaderboard(contestId) {
    try {
      const response = await fetch(
        `backend/contest/leaderboard.php?contestId=${contestId}`
      );

      if (!response.ok) {
        throw new Error("Failed to fetch leaderboard data.");
      }

      const data = await response.json();

      if (data.error) {
        throw new Error(data.error);
      }

      const leaderboardContainer = document.getElementById(
        "leaderboard-container"
      );
      leaderboardContainer.innerHTML = ""; // Clear existing leaderboard entries

      const leaderboard = data.leaderboard;

      if (leaderboard.length === 0) {
        leaderboardContainer.innerHTML = `<p class="text-gray-500">No participants found.</p>`;
        return;
      }

      leaderboard.forEach((entry, index) => {
        const listItem = document.createElement("li");
        listItem.className = "flex items-center space-x-4";

        const rankSpan = document.createElement("span");
        rankSpan.className = "font-medium text-gray-700";
        rankSpan.textContent = `${index + 1}.`;

        const profileImg = document.createElement("img");
        profileImg.src = entry.profile || "assets/img/background/avatar2.png";
        profileImg.alt = entry.user_name;
        profileImg.className = "w-10 h-10 rounded-full";

        const userDetailsDiv = document.createElement("div");
        userDetailsDiv.className = "flex-1";

        const userNameSpan = document.createElement("span");
        userNameSpan.className = "font-medium text-gray-700";
        userNameSpan.textContent = entry.user_name;

        userDetailsDiv.appendChild(userNameSpan);

        const scoreP = document.createElement("p");
        scoreP.className = "text-sm text-gray-500";
        scoreP.textContent = `${entry.total_solved_points} pts`;

        listItem.appendChild(rankSpan);
        listItem.appendChild(profileImg);
        listItem.appendChild(userDetailsDiv);
        listItem.appendChild(scoreP);

        leaderboardContainer.appendChild(listItem);
      });
    } catch (error) {
      console.error("Error fetching leaderboard:", error);
      const leaderboardContainer = document.getElementById(
        "leaderboard-container"
      );
      leaderboardContainer.innerHTML = `<p class="text-red-500">Failed to load leaderboard. Please try again later.</p>`;
    }
  }
</script>
  </body>
</html>
