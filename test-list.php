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

        <!-- Tests Section -->
        <section>
          <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-2">
              <img
                src="assets/img/background/dashboard-active.png"
                width="20px"
                alt="Tests Icon"
              />
              <h2 class="text-xl font-semibold">All Tests</h2>
            </div>
            <div class="flex items-center space-x-4">
              <img
                src="assets/img/background/down.png"
                width="20px"
                alt="Settings Icon"
              />
              <select
                class="appearance-none text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 font-semibold focus:outline-none"
                id="sort-options"
              >
                <option value="all" class="text-black">Show All</option>
                <option value="upcoming" class="text-black">Upcoming</option>
                <option value="submitted" class="text-black">Submitted</option>
                <option value="expired" class="text-black">Expired</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-4 gap-6">
            <!-- Test Cards -->
            <div class="relative p-6 bg-white shadow-md rounded-sm text-center">
              <button
                class="absolute top-2 right-2 px-3 py-1 text-sm text-white bg-gradient-to-r from-purple-500 to-pink-500 rounded"
              >
                Up Coming
              </button>
              <img
                src="https://via.placeholder.com/150x90"
                alt="TCS Logo"
                class="mx-auto mb-4 mt-4"
              />
              <h3 class="text-lg font-semibold mb-2">TCS Quiz Competition</h3>
              <p class="text-gray-500">TCS Campus Drive-2023</p>
            </div>

            <div class="relative p-6 bg-white shadow-md rounded-sm text-center">
              <button
                class="absolute top-2 right-2 px-3 py-1 text-sm text-white bg-gradient-to-r from-purple-500 to-pink-500 rounded"
              >
                Up Coming
              </button>
              <img
                src="https://via.placeholder.com/150x90"
                alt="Cognizant Logo"
                class="mx-auto mb-4 mt-4"
              />
              <h3 class="text-lg font-semibold mb-2">
                Cognizant Test Practice
              </h3>
              <p class="text-gray-500">CTS Campus Drive-2023</p>
            </div>

            <div class="relative p-6 bg-white shadow-md rounded-sm text-center">
              <button
                class="absolute top-2 right-2 px-3 py-1 text-sm text-white bg-red-500 rounded"
              >
                Expired
              </button>
              <img
                src="https://via.placeholder.com/150x90"
                alt="Flipkart Logo"
                class="mx-auto mb-4 mt-4"
              />
              <h3 class="text-lg font-semibold mb-2">Flipkart Model Test</h3>
              <p class="text-gray-500">Flipkart Campus Drive-2023</p>
            </div>

            <div class="relative p-6 bg-white shadow-md rounded-sm text-center">
              <button
                class="absolute top-2 right-2 px-3 py-1 text-sm text-white bg-green-500 rounded"
              >
                Submitted
              </button>
              <img
                src="https://via.placeholder.com/150x90"
                alt="Zoho Logo"
                class="mx-auto mb-4 mt-4"
              />
              <h3 class="text-lg font-semibold mb-2">Zoho Test Practice</h3>
              <p class="text-gray-500">Zoho Campus Drive-2023</p>
            </div>

            <div class="relative p-6 bg-white shadow-md rounded-sm text-center">
              <button
                class="absolute top-2 right-2 px-3 py-1 text-sm text-white bg-green-500 rounded"
              >
                Submitted
              </button>
              <img
                src="https://via.placeholder.com/150x90"
                alt="Amazon Logo"
                class="mx-auto mb-4 mt-4"
              />
              <h3 class="text-lg font-semibold mb-2">Amazon Model Test</h3>
              <p class="text-gray-500">MTSL Campus Drive-2023</p>
            </div>

            <div class="relative p-6 bg-white shadow-md rounded-sm text-center">
              <button
                class="absolute top-2 right-2 px-3 py-1 text-sm text-white bg-red-500 rounded"
              >
                Expired
              </button>
              <img
                src="https://via.placeholder.com/150x90"
                alt="IBM Logo"
                class="mx-auto mb-4 mt-4"
              />
              <h3 class="text-lg font-semibold mb-2">IBM Practice Test</h3>
              <p class="text-gray-500">MTSL Campus Drive-2023</p>
            </div>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>
