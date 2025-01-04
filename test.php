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
    <title>Thankyou | CodeCraft</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");

      * {
        font-family: "Syne", serif;
        font-optical-sizing: auto;

        font-style: normal;
      }
      .bg-color {
        background: #472d2d;
      }
    </style>
  </head>
  <body
    class="bg-[url('Mask.png')] bg-cover bg-center bg-no-repeat min-h-screen bg-gray-50 font-sans"
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

      <!-- Main Content Area -->
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
        <div
          class="flex justify-between items-center p-6 max-w-screen-lg mx-auto"
        >
          <div class="flex items-center space-x-4">
            <!-- Logo -->
            <img
              src="assets/img/background/c-logo.png"
              alt="Logo"
              class="md:w-[150px] h-auto"
            />
          </div>
          <div class="text-center flex flex-col items-center">
            <!-- Company Title and Subtitle -->
            <h1 class="text-xl font-semibold">TCS Quiz Competition</h1>
            <p class="text-sm text-gray-200">TCS Campus Drive-2023</p>
          </div>
          <div class="flex items-center space-x-4">
            <span
              class="text-xl bg-pink-300 text-purple-900 px-6 py-3 rounded-full flex items-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
              00:57:40
            </span>
          </div>
        </div>
        <div class="flex mt-6 justify-center mt-10">
          <!-- Left Sidebar -->

          <nav class="w-5/2 p-4 shadow rounded-lg bg-color">
            <ul class="space-y-4">
              <li class="text-lg font-semibold text-white cursor-pointer">
                Section
              </li>
              <li class="text-lg font-semibold text-white cursor-pointer">
                MCQ
              </li>
              <li class="text-lg font-semibold text-white cursor-pointer">
                Programming
              </li>
            </ul>
          </nav>

          <!-- Right Content -->
          <div class="w-3/2 bg-white p-6 shadow rounded-lg ml-4">
            <h2 class="text-xl font-bold mb-4 mx-auto text-center">
              TCS Quiz Competition Questions
            </h2>

            <div class="mb-6">
              <p class="font-semibold">
                1. Eesha works for ISRO where she is involved in a mission to
                intercept a comet that is likely to collide with Earth in 1
                month. She is developing a C program to calculate the trajectory
                of the missile to be launched to intercept and destroy the
                approaching comet. In order to achieve the highest accuracy of
                the missile trajectory, what data type should she use for the
                variables in her equation?
              </p>
              <div class="mt-4 grid grid-cols-2 gap-4">
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question1"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>Float</span>
                </label>
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question1"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>Int</span>
                </label>
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question1"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>Double</span>
                </label>
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question1"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>Long Int</span>
                </label>
              </div>
            </div>

            <div class="mb-6">
              <p class="font-semibold">
                2. A program reads in 500 integers in the range [0...100]
                representing the scores of 500 students. It then prints the
                frequency of each score above 50. What would be the best way for
                the program to store the frequencies?
              </p>
              <div class="mt-4 grid grid-cols-2 gap-4">
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question2"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>An Array Of 101 Numbers</span>
                </label>
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question2"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>An Array Of 50 Numbers</span>
                </label>
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question2"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>An Array Of 500 Numbers</span>
                </label>
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question2"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>An Array Of 200 Numbers</span>
                </label>
              </div>
            </div>

            <div class="mb-6">
              <p class="font-semibold">
                3. Which Are Incorrect Options For Array?
              </p>
              <div class="mt-4 grid grid-cols-2 gap-4">
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question3"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>Same Type</span>
                </label>
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question3"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>Sequential Memory Allocation</span>
                </label>
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question3"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>We Can Change Size Of Array At Run Time</span>
                </label>
                <label
                  class="flex items-center space-x-2 border border-gray-200 rounded-lg p-2 cursor-pointer hover:bg-gray-100"
                >
                  <input
                    type="radio"
                    name="question3"
                    class="h-5 w-5 text-purple-600"
                  />
                  <span>Counting Items In Array Is Appropriate</span>
                </label>
              </div>
            </div>

            <!-- Next Section Button -->
            <div class="flex justify-end">
              <button
                class="bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold py-2 px-6 rounded-full hover:bg-purple-700"
              >
                Next Section
              </button>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
