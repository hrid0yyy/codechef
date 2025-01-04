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
        <div
          class="md:w-[800px] rounded-lg p-3 bg-white shadow-lg space-y-6 mx-auto mt-8"
        >
          <!-- 1st Row: Logo, Title, Subtitle, Start Test Button -->
          <div class="grid grid-cols-3 gap-6">
            <div class="flex justify-center items-center">
              <img
                src="assets/img/background/c-logo.png"
                width="160px"
                alt="Company Logo"
                class="w-40 h-auto"
              />
            </div>
            <div class="flex flex-col justify-center">
              <h3 class="text-lg font-semibold">TCS Quiz Competition</h3>
              <p class="text-gray-500">TCS Campus Drive-2023</p>
            </div>
            <div class="flex justify-center items-center">
              <button
                class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full"
              >
                Start Test
              </button>
            </div>
          </div>

          <!-- 2nd Row: Icon, Title and Text with Transparent Green Background -->
          <div
            class="bg-green-100 p-4 rounded-lg text-darkgreen flex items-center justify-start gap-4"
          >
            <div class="flex items-center space-x-2">
              <img
                src="assets/img/background/Award3.svg"
                alt="Icon"
                class="w-6 h-6"
              />
              <span class="font-semibold">Certification</span>
            </div>
            <p class="text-darkgreen">
              We will issue you a free certificate of achievement if you score
              in the top 25%.
            </p>
          </div>

          <!-- 3rd Row: 3 Rows with 3 Columns of Text -->
          <div class="grid grid-rows-3 gap-4">
            <div class="grid grid-cols-3 gap-4">
              <div class="text-center">
                <h4 class="font-semibold">Questions Type</h4>
              </div>
              <div class="text-center">
                <h4 class="font-semibold">No of questions</h4>
              </div>
              <div class="text-center">
                <h4 class="font-semibold">Level</h4>
              </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
              <div class="text-center">
                <p class="text-gray-500">MCQ Questions</p>
              </div>
              <div class="text-center">
                <p class="text-gray-500">10 Questions</p>
              </div>
              <div class="text-center">
                <p class="text-gray-500">Medium</p>
              </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
              <div class="text-center">
                <p class="text-gray-500">Programing Question</p>
              </div>
              <div class="text-center">
                <p class="text-gray-500">1 Questions</p>
              </div>
              <div class="text-center">
                <p class="text-gray-500">Medium</p>
              </div>
            </div>
          </div>

          <!-- 4th Row: Rounded Box with Icon and Text in 2 Columns -->
          <div class="bg-white p-4 rounded-lg border space-y-4">
            <div class="flex items-center space-x-4">
              <img
                src="assets/img/background/monitor.svg"
                alt="Icon"
                class="w-6 h-6"
              />
              <p class="text-gray-500">
                We recommend having an environment ready, so you can solve
                problems outside of the browser.
              </p>
            </div>
            <div class="flex items-center space-x-4">
              <img
                src="assets/img/background/folder.png"
                alt="Icon"
                class="w-6 h-6"
              />
              <p class="text-gray-500">
                You can use any documentation, files, or other helpful
                resources.
              </p>
            </div>
            <div class="flex items-center space-x-4">
              <img
                src="assets/img/background/time.png"
                alt="Icon"
                class="w-6 h-6"
              />
              <p class="text-gray-500">58 minutes (no breaks allowed)</p>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
