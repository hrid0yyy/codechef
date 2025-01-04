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
    <title>CodeCraft Dashboard - Test Section</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");

      * {
        font-family: "Syne", serif;
        font-optical-sizing: auto;
        font-style: normal;
      }
      .relative-box {
        position: relative;
        bottom: 14rem;
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
                src="assets/img/background/dp.png"
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
            <div class="relative flex items-center">
              <img
                src="assets/img/background/search.png"
                alt="Search Icon"
                class="absolute left-3 w-4 h-4"
              />
              <input
                type="text"
                placeholder="Search"
                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full"
              />
            </div>
            <img
              src="assets/img/background/Bell.png"
              width="20px"
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

        <!-- 1st Row - Recent Solving Problems and Leaderboard -->
        <div class="grid grid-cols-3 gap-8">
          <!-- 1st Column: Recent Solving Problems -->
          <div class="col-span-2 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-purple-600 mb-4">
              Recent Solving Problems 
            </h2>
            <div class="col-span-2">
              <div class="flex space-x-4">
                <div class="bg-white shadow-md rounded-lg p-4">
                  <img
                    src="assets/img/background/c.jpeg"
                    width="150px"
                    height="150px"
                    alt="Problem image"
                    class="rounded mb-3 mx-auto"
                  />
                  <h3 class="font-semibold">Problem 1</h3>
                  <p class="text-gray-600 text-sm">
                    Short description of the problem...
                  </p>
                  <p class="text-sm text-gray-500">Language: Python</p>
                  <div class="flex items-center space-x-2 mt-2">
                    <div
                      class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center"
                    >
                      <p class="font-semibold text-sm">85%</p>
                    </div>
                    <span>Accuracy</span>
                  </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4">
                  <img
                    src="assets/img/background/c.jpeg"
                    width="150px"
                    height="150px"
                    alt="Problem image"
                    class="rounded mb-3 mx-auto"
                  />
                  <h3 class="font-semibold">Problem 1</h3>
                  <p class="text-gray-600 text-sm">
                    Short description of the problem...
                  </p>
                  <p class="text-sm text-gray-500">Language: Python</p>
                  <div class="flex items-center space-x-2 mt-2">
                    <div
                      class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center"
                    >
                      <p class="font-semibold text-sm">85%</p>
                    </div>
                    <span>Accuracy</span>
                  </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4">
                  <img
                    src="assets/img/background/c.jpeg"
                    width="150px"
                    height="150px"
                    alt="Problem image"
                    class="rounded mb-3 mx-auto"
                  />
                  <h3 class="font-semibold">Problem 1</h3>
                  <p class="text-gray-600 text-sm">
                    Short description of the problem...
                  </p>
                  <p class="text-sm text-gray-500">Language: Python</p>
                  <div class="flex items-center space-x-2 mt-2">
                    <div
                      class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center"
                    >
                      <p class="font-semibold text-sm">85%</p>
                    </div>
                    <span>Accuracy</span>
                  </div>
                </div>
              </div>

              <!-- Pagination Buttons -->
              <div class="flex justify-between mt-4 md:w-[800px]">
                <div
                  class="w-10 h-10 px-2 py-2 bg-gray-300 text-gray-700 rounded-full flex justify-center"
                >
                  <img
                    src="assets/img/background/left.png"
                    width="20px"
                    alt="Left Arrow Icon"
                  />
                </div>
                <span>Page 1 of 5</span>
                <div
                  class="w-10 h-10 py-2 bg-gray-300 text-gray-700 rounded-full flex justify-center"
                >
                  <img
                    src="assets/img/background/right.png"
                    width="20px"
                    alt="Right Arrow Icon"
                  />
                </div>
              </div>
            </div>
          </div>

          <!-- 2nd Column: Leaderboard -->
          <!-- 2nd Column: Leaderboard -->
          <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-purple-600 mb-4">
              Leaderboard
            </h2>
            <div class="space-y-4">
              <!-- Top 3 Ranks with Highlights -->
              <div
                class="flex items-center justify-between bg-yellow-200 rounded-lg px-4 py-2"
              >
                <div class="flex items-center space-x-4">
                  <img
                    src="https://via.placeholder.com/40"
                    alt="Avatar"
                    class="w-10 h-10 rounded-full"
                  />
                  <span class="font-semibold">1. Alice</span>
                </div>
                <div class="flex items-center space-x-2">
                  <img
                    src="assets/img/background/trophy-gold.png"
                    alt="Trophy"
                    class="w-6"
                  />
                  <span class="font-semibold text-purple-600">1200 pts</span>
                </div>
              </div>
              <div
                class="flex items-center justify-between bg-gray-200 rounded-lg px-4 py-2"
              >
                <div class="flex items-center space-x-4">
                  <img
                    src="https://via.placeholder.com/40"
                    alt="Avatar"
                    class="w-10 h-10 rounded-full"
                  />
                  <span class="font-semibold">2. Bob</span>
                </div>
                <div class="flex items-center space-x-2">
                  <img
                    src="assets/img/background/trophy-silver.png"
                    alt="Trophy"
                    class="w-6"
                  />
                  <span class="font-semibold text-purple-600">1150 pts</span>
                </div>
              </div>
              <div
                class="flex items-center justify-between bg-orange-200 rounded-lg px-4 py-2"
              >
                <div class="flex items-center space-x-4">
                  <img
                    src="https://via.placeholder.com/40"
                    alt="Avatar"
                    class="w-10 h-10 rounded-full"
                  />
                  <span class="font-semibold">3. Charlie</span>
                </div>
                <div class="flex items-center space-x-2">
                  <img
                    src="assets/img/background/trophy-bronze.png"
                    alt="Trophy"
                    class="w-6"
                  />
                  <span class="font-semibold text-purple-600">1100 pts</span>
                </div>
              </div>

              <!-- Other Ranks -->
              <div class="flex items-center justify-between px-4 py-2">
                <div class="flex items-center space-x-4">
                  <img
                    src="https://via.placeholder.com/40"
                    alt="Avatar"
                    class="w-10 h-10 rounded-full"
                  />
                  <span>4. Daniel</span>
                </div>
                <span class="font-semibold text-gray-600">1050 pts</span>
              </div>
              <div class="flex items-center justify-between px-4 py-2">
                <div class="flex items-center space-x-4">
                  <img
                    src="https://via.placeholder.com/40"
                    alt="Avatar"
                    class="w-10 h-10 rounded-full"
                  />
                  <span>5. Eve</span>
                </div>
                <span class="font-semibold text-gray-600">1000 pts</span>
              </div>
            </div>
          </div>
        </div>

        <!-- 2nd Row - Upcoming Coding Contests and Performance Dashboard -->
        <div class="grid grid-cols-3 gap-8 mt-8">
          <!-- 1st Column: Upcoming Coding Contests -->
          <div class="col-span-2 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-purple-600 mb-4">
              Upcoming Coding Contests
            </h2>
            <div class="grid grid-cols-3 gap-6">
              <!-- Contest 1 -->
              <div
                class="flex flex-col items-center space-y-4 p-4 border border-gray-300 rounded-lg"
              >
                <img
                  src="https://via.placeholder.com/80"
                  alt="Contest Image"
                  class="rounded-lg mb-4"
                />
                <div>
                  <h3 class="font-semibold">Contest 1</h3>
                  <p class="text-gray-600 text-sm">Date: Jan 15, 2025</p>
                  <p class="text-sm text-gray-500">Sponsored By: XYZ Corp</p>
                  <p class="font-semibold text-purple-600">Prize: $1000</p>
                </div>
                <button
                  class="mt-4 px-6 py-2 bg-purple-400 text-white rounded-full hover:bg-purple-500"
                >
                  Register Now
                </button>
              </div>

              <!-- Contest 2 -->
              <div
                class="flex flex-col items-center space-y-4 p-4 border border-gray-300 rounded-lg"
              >
                <img
                  src="https://via.placeholder.com/80"
                  alt="Contest Image"
                  class="rounded-lg mb-4"
                />
                <div>
                  <h3 class="font-semibold">Contest 2</h3>
                  <p class="text-gray-600 text-sm">Date: Feb 20, 2025</p>
                  <p class="text-sm text-gray-500">Sponsored By: ABC Ltd</p>
                  <p class="font-semibold text-purple-600">Prize: $1500</p>
                </div>
                <button
                  class="mt-4 px-6 py-2 bg-purple-400 text-white rounded-full hover:bg-purple-500"
                >
                  Register Now
                </button>
              </div>

              <!-- Contest 3 -->
              <div
                class="flex flex-col items-center space-y-4 p-4 border border-gray-300 rounded-lg"
              >
                <img
                  src="https://via.placeholder.com/80"
                  alt="Contest Image"
                  class="rounded-lg mb-4"
                />
                <div>
                  <h3 class="font-semibold">Contest 3</h3>
                  <p class="text-gray-600 text-sm">Date: Mar 5, 2025</p>
                  <p class="text-sm text-gray-500">Sponsored By: DEF Group</p>
                  <p class="font-semibold text-purple-600">Prize: $2000</p>
                </div>
                <button
                  class="mt-4 px-6 py-2 bg-purple-400 text-white rounded-full hover:bg-purple-500"
                >
                  Register Now
                </button>
              </div>
            </div>

            <!-- Pagination -->
            <div class="relative-box flex justify-between mt-4 md:w-[800px]">
              <div
                class="w-10 h-10 px-2 py-2 bg-gray-300 text-gray-700 rounded-full flex justify-center"
              >
                <img
                  src="assets/img/background/left.png"
                  width="20px"
                  alt="Left Arrow Icon"
                />
              </div>
              <div
                class="w-10 h-10 py-2 bg-gray-300 text-gray-700 rounded-full flex justify-center"
              >
                <img
                  src="assets/img/background/right.png"
                  width="20px"
                  alt="Right Arrow Icon"
                />
              </div>
            </div>
          </div>

          <!-- 2nd Column: Performance Dashboard -->
          <div class="grid grid-cols-2 gap-6">
            <!-- Column 1: Problem Solving -->
            <div
              class="bg-gradient-to-r from-purple-50 to-white shadow-lg rounded-lg p-6"
            >
              <h2 class="text-2xl font-bold text-purple-600 mb-4">
                Problem Solving
              </h2>
              <div class="space-y-4 text-gray-700">
                <div class="flex items-center justify-between">
                  <span class="font-medium">Problems Solved:</span>
                  <span class="font-semibold">25/50</span>
                </div>
                <div class="flex items-center justify-between">
                  <span class="font-medium">Contest Participations:</span>
                  <span class="font-semibold">5</span>
                </div>
                <div class="flex items-center justify-between">
                  <span class="font-medium">Leaderboard Position:</span>
                  <span class="font-semibold text-green-500">5th</span>
                </div>
              </div>
            </div>

            <!-- Column 2: Performance Stats -->
            <div
              class="bg-gradient-to-r from-white to-purple-50 shadow-lg rounded-lg p-6"
            >
              <h2 class="text-2xl font-bold text-purple-600 mb-4">
                Performance Stats
              </h2>
              <div class="space-y-4 text-gray-700">
                <div class="flex items-center justify-between">
                  <span class="font-medium">Accuracy:</span>
                  <span class="font-semibold text-blue-500">90%</span>
                </div>
                <div class="flex items-center justify-between">
                  <span class="font-medium">Top Contest Position:</span>
                  <span class="font-semibold text-yellow-500">2nd</span>
                </div>
                <div class="flex items-center justify-between">
                  <span class="font-medium">Leetcode Score:</span>
                  <span class="font-semibold text-purple-500">1300</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
