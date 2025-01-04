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
            <a href="#" class="flex items-center space-x-4">
              <img
                src="assets/img/background/dark.png"
                width="20px"
                alt="Dark Mode Icon"
              />
              <span>Dark Mode</span>
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
          <h1 class="text-2xl font-bold">Tests For You!</h1>
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
              src="https://via.placeholder.com/40"
              alt="Profile Icon"
              class="rounded-full cursor-pointer"
            />
          </div>
        </header>

        <!-- Leaderboard Page -->
        <div class="min-h-screen p-8">
          <!-- Page Title -->
          <header class="text-center mb-8">
            <h1 class="text-4xl font-extrabold">Leaderboard</h1>
            <p class="">Track your position and strive for the top!</p>
          </header>

          <!-- Leaderboard Table -->
          <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <table class="min-w-full text-left text-gray-800">
              <thead
                class="bg-gradient-to-r from-purple-500 to-pink-500 text-white"
              >
                <tr>
                  <th class="py-4 px-6">Rank</th>
                  <th class="py-4 px-6">Profile</th>
                  <th class="py-4 px-6">Name</th>
                  <th class="py-4 px-6">Points</th>
                  <th class="py-4 px-6">Problems Solved</th>
                </tr>
              </thead>
              <tbody>
                <!-- Example Row -->
                <tr class="border-b hover:bg-purple-500/10">
                  <td class="py-4 px-6 font-medium">1</td>
                  <td class="py-4 px-6">
                    <img
                      src="assets/img/background/dp.jpeg"
                      alt="Profile Picture"
                      class="w-12 h-12 rounded-full border-2 border-purple-500"
                    />
                  </td>
                  <td class="py-4 px-6">John Doe</td>
                  <td class="py-4 px-6">1540</td>
                  <td class="py-4 px-6">45</td>
                </tr>
                <tr class="border-b hover:bg-purple-500/10">
                  <td class="py-4 px-6 font-medium">2</td>
                  <td class="py-4 px-6">
                    <img
                      src="assets/img/background/dp.jpeg"
                      alt="Profile Picture"
                      class="w-12 h-12 rounded-full border-2 border-purple-500"
                    />
                  </td>
                  <td class="py-4 px-6">Jane Smith</td>
                  <td class="py-4 px-6">1490</td>
                  <td class="py-4 px-6">42</td>
                </tr>
                <tr class="hover:bg-purple-500/10">
                  <td class="py-4 px-6 font-medium">3</td>
                  <td class="py-4 px-6">
                    <img
                      src="assets/img/background/dp.jpeg"
                      alt="Profile Picture"
                      class="w-12 h-12 rounded-full border-2 border-purple-500"
                    />
                  </td>
                  <td class="py-4 px-6">Alice Brown</td>
                  <td class="py-4 px-6">1450</td>
                  <td class="py-4 px-6">40</td>
                </tr>
                <tr class="hover:bg-purple-500/10">
                  <td class="py-4 px-6 font-medium">3</td>
                  <td class="py-4 px-6">
                    <img
                      src="assets/img/background/dp.jpeg"
                      alt="Profile Picture"
                      class="w-12 h-12 rounded-full border-2 border-purple-500"
                    />
                  </td>
                  <td class="py-4 px-6">Alice Brown</td>
                  <td class="py-4 px-6">1450</td>
                  <td class="py-4 px-6">40</td>
                </tr>
                <tr class="hover:bg-purple-500/10">
                  <td class="py-4 px-6 font-medium">3</td>
                  <td class="py-4 px-6">
                    <img
                      src="assets/img/background/dp.jpeg"
                      alt="Profile Picture"
                      class="w-12 h-12 rounded-full border-2 border-purple-500"
                    />
                  </td>
                  <td class="py-4 px-6">Alice Brown</td>
                  <td class="py-4 px-6">1450</td>
                  <td class="py-4 px-6">40</td>
                </tr>
                <!-- Include Owner's Position -->
                <tr class="hover:bg-purple-500/10">
                  <td class="py-4 px-6 font-medium">10</td>
                  <td class="py-4 px-6">
                    <img
                      src="assets/img/background/dp.jpeg"
                      alt="Profile Picture"
                      class="w-12 h-12 rounded-full border-2 border-purple-500"
                    />
                  </td>
                  <td class="py-4 px-6">Owner</td>
                  <td class="py-4 px-6">1000</td>
                  <td class="py-4 px-6">25</td>
                </tr>
              </tbody>
            </table>
            <div class="text-center mt-4 mb-4">
              <button
                class="bg-gradient-to-r from-purple-500 to-pink-500 text-white py-2 px-4 rounded-lg hover:opacity-90 transition"
              >
                Show All Coders
              </button>
            </div>
          </div>

          <!-- Features Section -->
          <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Feature 1 -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
              <h3 class="text-2xl font-semibold text-purple-500">
                Weekly Challenges
              </h3>
              <p class="text-gray-700 mt-2">
                Participate in weekly challenges to earn bonus points and climb
                the leaderboard faster.
              </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
              <h3 class="text-2xl font-semibold text-purple-500">
                Achievements
              </h3>
              <p class="text-gray-700 mt-2">
                Unlock badges for milestones like solving 50 problems or
                maintaining a top-10 position.
              </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
              <h3 class="text-2xl font-semibold text-purple-500">
                Personalized Feedback
              </h3>
              <p class="text-gray-700 mt-2">
                Get insights into your strengths and areas for improvement based
                on your performance.
              </p>
            </div>

            <!-- New Feature: Real-time Stats -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
              <h3 class="text-2xl font-semibold text-purple-500">
                Real-time Stats
              </h3>
              <p class="text-gray-700 mt-2">
                See live updates of your rank and points as you solve problems
                in coding contests.
              </p>
            </div>

            <!-- New Feature: Peer Comparisons -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
              <h3 class="text-2xl font-semibold text-purple-500">
                Peer Comparisons
              </h3>
              <p class="text-gray-700 mt-2">
                Compare your stats with peers to identify competitive strengths
                and weaknesses.
              </p>
            </div>

            <!-- New Feature: Community Events -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
              <h3 class="text-2xl font-semibold text-purple-500">
                Community Events
              </h3>
              <p class="text-gray-700 mt-2">
                Join special community events for exclusive prizes and leader
                boosts.
              </p>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
