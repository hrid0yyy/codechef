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
    <title>Contest Details - CodeCraft</title>
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
            <img src="assets/img/background/logo.png" alt="Dashboard logo" />
          </div>

          <!-- Menu Links -->
          <nav class="space-y-6">
            <a
              href="dashboard.php"
              class="flex items-center space-x-4 text-purple-600"
            >
              <img
                src="assets/img/background/document-active.png"
                width="20px"
                alt="Dashboard Icon"
              />
              <span>Dashboard</span>
            </a>
            <a href="test-list.php" class="flex items-center space-x-4">
              <img
                src="assets/img/background/test-active.png"
                width="20px"
                alt="Tests Icon"
              />
              <span>Tests</span>
            </a>
            <a href="problems.php" class="flex items-center space-x-4">
              <img
                src="assets/img/background/document.png"
                width="20px"
                alt="Courses Icon"
              />
              <span>Problem Sets</span>
            </a>
            <a href="profile-coder.php" class="flex items-center space-x-4">
              <img
                src="<?php echo htmlspecialchars($userProfilePicture); ?>"
                width="20px"
                alt="Profile Icon"
              />
              <span>Profile</span>
            </a>
            <a href="leaderboard.php" class="flex items-center space-x-4">
              <img
                src="assets/img/background/leaderboard.png"
                width="20px"
                alt="Leaderboard Icon"
              />
              <span>Leaderboard</span>
            </a>
            <a href="inbox.php" class="flex items-center space-x-4">
              <img
                src="assets/img/background/chat.png"
                width="20px"
                alt="Chat Icon"
              />
              <span>Inbox</span>
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
  style="width: 40px; height: 40px; object-fit: cover"
/>

            </div>
        </header>
  

        <!-- Contest Banner -->
        <div class="bg-gradient-to-r from-purple-50 to-white shadow-lg rounded-lg p-4">
  <!-- Contest Banner -->
  <img
  id="contest-banner"
  src="assets/img/background/Chopper.PNG"
  alt="Contest Banner"
  class="rounded-lg mb-6 w-full max-w-md"
/>

  <!-- Contest Title -->
  <h2 id="contest-title" class="text-3xl font-bold text-purple-600 mb-4">
    Upcoming Contest: Hackathon coding contest
  </h2>

  <!-- Contest Description -->
  <p id="contest-description" class="text-gray-700 text-lg mb-6">
    The CodeCraft Challenge 2025 is your chance to showcase your skills and
    compete with top coders around the globe. Join us for an exciting contest
    filled with challenges and amazing prizes!
  </p>

  <!-- Contest Details -->
  <div class="grid grid-cols-2 gap-6 text-gray-700">
    <div class="flex flex-col space-y-2">
      <p class="font-medium">Total Slot:</p>
      <p id="contestants" class="font-semibold text-purple-600">500+</p>
    </div>
    <div class="flex flex-col space-y-2">
      <p class="font-medium">Registration Starts:</p>
      <p id="registration-start" class="font-semibold text-purple-600">
        Jan 10, 2025
      </p>
    </div>
    <div class="flex flex-col space-y-2">
      <p class="font-medium">Registration Ends:</p>
      <p id="registration-end" class="font-semibold text-purple-600">
        Jan 31, 2025
      </p>
    </div>
    <div class="flex flex-col space-y-2">
      <p class="font-medium">Contest Starts:</p>
      <p id="contest-start" class="font-semibold text-purple-600">
        Feb 1, 2025, 10:00 AM
      </p>
    </div>
    <div class="flex flex-col space-y-2">
      <p class="font-medium">Contest Ends:</p>
      <p id="contest-end" class="font-semibold text-purple-600">
        Feb 1, 2025, 5:00 PM
      </p>
    </div>
  </div>

  <!-- Register Button -->
  <div class="mt-8 text-center">
    <button
      class="px-8 py-4 bg-purple-500 text-white font-semibold text-lg rounded-full shadow-lg hover:bg-purple-600"
      onclick="toggleModal()"
    >
      Register Now
    </button>
  </div>
</div>


        <!-- Modal -->
        <div
  id="registrationModal"
  class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50"
>
  <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
    <h2 class="text-xl font-bold text-purple-600 mb-4">
      Confirm Registration
    </h2>
    <p class="text-gray-700 text-lg mb-6">
      Are you sure you want to register for this contest?
    </p>
    <div class="mt-6 flex justify-end space-x-4">
      <button
        type="button"
        class="px-6 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300"
        onclick="toggleModal()"
      >
        Cancel
      </button>
      <button
        type="button"
        class="px-6 py-2 bg-purple-500 text-white font-medium rounded-lg hover:bg-purple-600"
        onclick="registerForContest()"
      >
        Yes, Register
      </button>
    </div>
  </div>
</div>

      </main>
    </div>

    <script>
   function toggleModal() {
    const modal = document.getElementById("registrationModal");
    modal.classList.toggle("hidden");
  }

  function registerForContest() {
    const contestId = new URLSearchParams(window.location.search).get("contest_id");
    if (!contestId) {
      alert("No contest selected for registration.");
      return;
    }

    // Make the POST request to the backend
    fetch("backend/contest/register.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `contest_id=${encodeURIComponent(contestId)}`,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(data.success);
          toggleModal();
        } else {
          alert(data.error);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred while registering. Please try again later.");
      });
  }




  document.addEventListener("DOMContentLoaded", function () {
    // Get the contest_id from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const contestId = urlParams.get("contest_id");

    // If contest_id is missing, show an error message
    if (!contestId) {
      alert("Contest ID is required to load contest details.");
      return;
    }

    // Fetch contest details from the API
    fetch(`backend/contest/details.php?contest_id=${contestId}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Failed to fetch contest details.");
        }
        return response.json();
      })
      .then((data) => {
        // Populate the page with contest data
        document.getElementById("contest-banner").src = data.banner || "assets/img/background/default-banner.png";
        document.getElementById("contest-title").textContent = data.contest_name || "Contest Title Not Found";
        document.getElementById("contest-description").textContent = data.description || "No description available.";
        document.getElementById("contestants").textContent = data.contestants ? `${data.contestants}+` : "N/A";
        document.getElementById("registration-start").textContent = new Date(data.registration_start_time).toLocaleDateString();
        document.getElementById("registration-end").textContent = new Date(data.registration_end_time).toLocaleDateString();
        document.getElementById("contest-start").textContent = new Date(data.start_time).toLocaleString();
        document.getElementById("contest-end").textContent = new Date(data.end_time).toLocaleString();
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Failed to load contest details. Please try again later.");
      });
  });

  function toggleModal() {
    const modal = document.getElementById("registrationModal");
    modal.classList.toggle("hidden");
  }


    </script>
  </body>
</html>
