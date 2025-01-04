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
    <title>Admin Dashboard</title>
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
              class="flex items-center space-x-4 text-purple-600"
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
          <a href="profile.php" class="flex items-center space-x-4">
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
          <h1 class="text-2xl font-bold">Admin Dashboard</h1>
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

        <!-- Dashboard Content -->
        <div class="grid grid-cols-2 gap-6">
          <!-- Contests Card -->
          <div
            class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center space-y-4"
          >
            <img
              src="assets/img/background/contests.png"
              alt="Contests Icon"
              width="50px"
            />
            <h2 class="text-lg font-semibold text-purple-600">Contests</h2>
            <p class="text-gray-600 text-center">
              Manage and view all ongoing and upcoming contests.
            </p>
            <button
              class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full"
            >
              Go to Contests
            </button>
          </div>

          <!-- Problem Sets Card -->
          <div
            class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center space-y-4"
          >
            <img
              src="assets/img/background/problem-sets.png"
              alt="Problem Sets Icon"
              width="50px"
            />
            <h2 class="text-lg font-semibold text-purple-600">Problem Sets</h2>
            <p class="text-gray-600 text-center">
              Create, edit, and organize problem sets for contests or practice.
            </p>
            <button
              class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full"
            >
              Go to Problem Sets
            </button>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>