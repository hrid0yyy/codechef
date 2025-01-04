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
    <title>CodeCraft Dashboard - Settings</title>
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
          <h1 class="text-2xl font-bold">Account Settings</h1>
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

        <!-- Settings Section inside the Test Section -->
        <div class="bg-white shadow-lg rounded-lg p-8 space-y-6 mx-auto mt-8">
          <!-- Change Email -->
          <h2 class="text-2xl font-semibold text-purple-600">Change Email</h2>
          <div class="flex flex-col mb-4">
            <label for="email" class="font-medium text-gray-600"
              >New Email</label
            >
            <input
              type="email"
              id="email"
              class="border border-gray-300 rounded-lg p-2 mt-2"
              placeholder="Enter your new email address"
            />
          </div>

          <!-- Change Password -->
          <h2 class="text-2xl font-semibold text-purple-600">
            Change Password
          </h2>
          <div class="flex flex-col mb-4">
            <label for="password" class="font-medium text-gray-600"
              >New Password</label
            >
            <input
              type="password"
              id="password"
              class="border border-gray-300 rounded-lg p-2 mt-2"
              placeholder="Enter your new password"
            />
          </div>
          <div class="flex flex-col mb-4">
            <label for="confirm-password" class="font-medium text-gray-600"
              >Confirm New Password</label
            >
            <input
              type="password"
              id="confirm-password"
              class="border border-gray-300 rounded-lg p-2 mt-2"
              placeholder="Confirm your new password"
            />
          </div>

          <!-- Change Mobile Number -->
          <h2 class="text-2xl font-semibold text-purple-600">
            Change Mobile Number
          </h2>
          <div class="flex flex-col mb-6">
            <label for="mobile-number" class="font-medium text-gray-600"
              >New Mobile Number</label
            >
            <input
              type="text"
              id="mobile-number"
              class="border border-gray-300 rounded-lg p-2 mt-2"
              placeholder="Enter your new mobile number"
            />
          </div>

          <!-- Save Changes Button -->
          <div class="flex justify-center mt-6">
            <button
              class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full"
            >
              Save Changes
            </button>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
