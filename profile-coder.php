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
              class="flex items-center space-x-4"
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
                src="assets/img/background/test.png"
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
            <a href="profile-coder.php" class="flex items-center space-x-4 text-purple-600">
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
          <h1 class="text-2xl font-bold">Profile</h1>
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

        <!-- Tests Section -->
        <div class="rounded-lg p-6 bg-white shadow-lg space-y-6 mx-auto">
          <span><a href="profile.php">Edit</a></span>
          <!-- Cover Picture and Profile Picture -->
          <div class="relative">
            <img
              src="assets/img/background/rb_9814.png"
              alt="Cover Picture"
              class="w-full h-48 object-cover rounded-t-lg"
            />
            <div class="absolute -bottom-12 left-8">


            <img
    src="<?php echo htmlspecialchars($userProfilePicture); ?>"
    alt="Profile Picture"
    class="w-24 h-24 rounded-full border-4 border-white shadow-lg"
    
/>
            </div>
          </div>

          <!-- Name, Bio, Title -->
          <div class="mt-16 px-8 text-center">
            <h2 class="text-2xl font-bold"><?php echo htmlspecialchars($userData['name']); ?></h2>
            <p class="text-gray-500">
            <?php echo htmlspecialchars($userData['bio']); ?>
            </p>
          </div>

          <!-- Skills Section -->
          <div class="px-8">
    <h3 class="text-lg font-semibold mb-4">Skills</h3>
    <div class="flex flex-wrap gap-2">
        <?php
        if (!empty($userData['skills'])) {
            $skillsArray = explode(", ", $userData['skills']); // Split string into array
            
            // Define a color palette for different skills
            $colors = [
                "bg-purple-100 text-purple-600",
                "bg-green-100 text-green-600",
                "bg-blue-100 text-blue-600",
                "bg-yellow-100 text-yellow-600",
                "bg-red-100 text-red-600",
                "bg-indigo-100 text-indigo-600",
                "bg-pink-100 text-pink-600",
                "bg-gray-100 text-gray-600"
            ];

            foreach ($skillsArray as $index => $skill) {
                $randomColor = $colors[$index % count($colors)]; // Cycle through colors
                echo "<span class='px-3 py-1 $randomColor rounded-full text-sm'>" . htmlspecialchars(trim($skill)) . "</span>";
            }
        } else {
            echo "<p class='text-gray-500'>No skills added yet.</p>";
        }
        ?>
    </div>
</div>

          <!-- Problem Solving and Performance Stats -->
          <div class="px-8 grid grid-cols-2 gap-6 mt-8">
    <div class="bg-purple-50 p-4 rounded-lg text-center">
        <h4 class="text-lg font-semibold">Problem Solved</h4>
        <p id="totalSolved" class="text-purple-600 text-2xl font-bold">Loading...</p>
    </div>
    <div class="bg-green-50 p-4 rounded-lg text-center">
        <h4 class="text-lg font-semibold">Leaderboard Position</h4>
        <p id="leaderboardRank" class="text-green-600 text-2xl font-bold">Loading...</p>
    </div>
</div>


          <!-- Performance Chart -->
          <div class="px-8 mt-8">
            <h3 class="text-lg font-semibold mb-4">Performance Metrics</h3>
            <div class="flex items-center justify-around">
              <div class="text-center">
                <p class="text-sm text-gray-500">Accuracy</p>
                <div class="text-2xl font-bold text-purple-600">92%</div>
              </div>
              <div class="text-center">
                <p class="text-sm text-gray-500">Solved in Time</p>
                <div class="text-2xl font-bold text-green-600">87%</div>
              </div>
              <div class="text-center">
                <p class="text-sm text-gray-500">Challenges Completed</p>
                <div class="text-2xl font-bold text-blue-600">45</div>
              </div>
            </div>
          </div>

          <!-- Social Links -->
          <div class="px-8 mt-8">
            <h3 class="text-lg font-semibold mb-4">Connect</h3>
            <div class="flex items-center space-x-4">
              <a href="<?php echo htmlspecialchars($userData['linkedinUrl']); ?>" class="text-blue-500 hover:underline">LinkedIn</a>
              <a href="<?php echo htmlspecialchars($userData['githubUrl']); ?>" class="text-gray-600 hover:underline">GitHub</a>
              <a href="<?php echo htmlspecialchars($userData['portfolioUrl']); ?>" class="text-purple-600 hover:underline">Portfolio</a>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
  <script>

async function fetchUserRank() {
    try {
        const response = await fetch("backend/ud/get_user_rank.php");
        const data = await response.json();

        if (data.status === "success") {
            document.getElementById("totalSolved").textContent = data.total_problems_solved ;
            document.getElementById("leaderboardRank").textContent = "#" + data.rank_position;
        } else {
            console.error("Error fetching data:", data.message);
        }
    } catch (error) {
        console.error("Failed to fetch rank data:", error);
    }
}

// Fetch data when the page loads
document.addEventListener("DOMContentLoaded", fetchUserRank);
</script>

  </script>
</html>
