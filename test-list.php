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
    <title>Ongoing Contests - CodeCraft</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");

      * {
        font-family: "Syne", serif;
        font-optical-sizing: auto;
        font-style: normal;
      }

      .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .hover-scale:hover {
        transform: scale(1.05);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
      }
    </style>
  </head>
  <body class="bg-gray-100 min-h-screen font-sans">
    <div class="container mx-auto p-8">
      <!-- Header -->
      <header class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-purple-600">Ongoing Contests</h1>
        <div class="flex items-center space-x-4">
          <div class="relative flex items-center">
            <img
              src="assets/img/background/search.png"
              alt="Search Icon"
              class="absolute left-3 w-4 h-4"
            />
            <input
              type="text"
              placeholder="Search contests..."
              class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full"
              oninput="searchContests(this.value)"
            />
          </div>
        </div>
      </header>

      <!-- Ongoing Contests Section -->
      <div id="ongoing-contests" class="grid grid-cols-3 gap-6">
        <!-- Contest cards will be dynamically populated here -->
      </div>

      <!-- No Contests Message -->
      <p id="no-contests" class="text-center text-gray-500 hidden">
        No ongoing contests found.
      </p>
    </div>

    <script>
      // Fetch and display ongoing contests
      async function fetchOngoingContests(search = "") {
        try {
          const response = await fetch(
            `backend/contest/ongoing.php?search=${encodeURIComponent(search)}`
          );
          const contests = await response.json();

          // Get the container and no-contests message
          const container = document.getElementById("ongoing-contests");
          const noContestsMessage = document.getElementById("no-contests");

          // Clear any existing content
          container.innerHTML = "";

          if (contests.length === 0) {
            // Show no-contests message if no contests are found
            noContestsMessage.classList.remove("hidden");
            return;
          }

          // Hide the no-contests message
          noContestsMessage.classList.add("hidden");

          // Populate the container with contest cards
          contests.forEach((contest) => {
            const contestCard = `
              <div class="hover-scale bg-white p-4 border border-gray-300 rounded-lg">
                <img
                  src="${contest.banner || 'https://via.placeholder.com/150'}"
                  alt="${contest.contest_name} Banner"
                  class="rounded-lg mb-4 w-full h-40 object-cover"
                />
                <h3 class="text-lg font-bold text-purple-600 mb-2">
                  ${contest.contest_name}
                </h3>
                <p class="text-gray-500 mb-4">${contest.description}</p>
                <p class="text-sm text-gray-700 mb-2">
                  <strong>Start:</strong> ${new Date(
                    contest.start_time
                  ).toLocaleString()}
                </p>
                <p class="text-sm text-gray-700 mb-2">
                  <strong>End:</strong> ${new Date(
                    contest.end_time
                  ).toLocaleString()}
                </p>
                <button
                  class="mt-4 px-6 py-2 bg-purple-500 text-white rounded-full hover:bg-purple-600"
                  onclick="viewContestDetails(${contest.contest_id})"
                >
                  View Details
                </button>
              </div>
            `;
            container.innerHTML += contestCard;
          });
        } catch (error) {
          console.error("Error fetching contests:", error);
          alert("Failed to load contests. Please try again later.");
        }
      }

      // Redirect to contest details page
  // Redirect to contest details page after checking registration
async function viewContestDetails(contestId) {
  try {

  
    if (!userId) {
      alert("User is not logged in.");
      return;
    }

    // Call the PHP backend to check registration
    const response = await fetch(`backend/contest/check.php?contestId=${contestId}&userId=${userId}`);
    const data = await response.json();

    if (data.error) {
      alert(data.error);
      return;
    }

    if (data.isRegistered) {
      // User is registered, redirect to the contest page
      window.location.href = `ongoing-contest.php?contest_id=${contestId}`;
    } else {
      // User is not registered, show an alert or take appropriate action
      alert("You are not registered for this contest. ");
    }
  } catch (error) {
    console.error("Error checking registration:", error);
    alert("An error occurred while checking registration. Please try again later.");
  }
}


      // Handle search input
      function searchContests(query) {
        fetchOngoingContests(query);
      }

      // Initialize the page
      document.addEventListener("DOMContentLoaded", () => {
        fetchOngoingContests();
      });
    </script>
  </body>
</html>
