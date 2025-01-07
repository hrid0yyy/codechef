<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="assets/img/background/fav-logo.png" />
    <title>CodeCraft Chat</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");

      * {
        font-family: "Syne", serif;
        font-optical-sizing: auto;
        font-style: normal;
      }


      #chat-box {
    display: flex;
    flex-direction: column;
    gap: 10px;
    background-color: #f5f5f5;
    padding: 15px;
    height: 500px;
    overflow-y: auto;
    border-radius: 10px;
}

#chat-box div {
    display: flex;
    align-items: flex-end;
    margin-bottom: 10px;
}

.bg-gray-300 {
    background-color: #e4e6eb; /* Messenger gray bubble */
    color: #000;
}

.bg-blue-500 {
    background-color: #0084ff; /* Messenger blue bubble */
    color: #fff;
}

.rounded-2xl {
    border-radius: 18px;
    position: relative;
    padding-bottom: 15px; /* Adds space for timestamp */
}

.shadow-md {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.text-xs {
    font-size: 12px;
}

.text-gray-400 {
    color: rgba(0, 0, 0, 0.5);
}

.absolute {
    position: absolute;
    right: 10px;
    bottom: 5px;
}

    </style>
  </head>
  <body class="bg-[url('assets/img/background/Mask.png')] bg-cover bg-center bg-no-repeat min-h-screen font-sans">
    <div class="flex">
      <!-- Sidebar -->
      <aside class="w-1/5 shadow-lg flex flex-col justify-between h-screen sticky top-0">
        <div class="p-6">
          <div class="text-2xl font-bold text-purple-600 mb-10">
            <img src="assets/img/background/logo.png" alt="Dashboard logo" />
          </div>
          <nav class="space-y-6">
            <a href="dashboard.php" class="flex items-center space-x-4">
              <img src="assets/img/background/document.png" width="20px" alt="Dashboard Icon" />
              <span>Dashboard</span>
            </a>
            <a href="test-list.php" class="flex items-center space-x-4">
              <img src="assets/img/background/test.png" width="20px" alt="Tests Icon" />
              <span>Tests</span>
            </a>
            <a href="problems.php" class="flex items-center space-x-4">
              <img src="assets/img/background/document.png" width="20px" alt="Courses Icon" />
              <span>Problem Sets</span>
            </a>
            <a href="profile-coder.php" class="flex items-center space-x-4">
              <img src="assets/img/background/dp.png" width="20px" alt="Profile Icon" />
              <span>Profile</span>
            </a>
            <a href="leaderboard.php" class="flex items-center space-x-4">
              <img src="assets/img/background/leaderboard.png" width="20px" alt="Leaderboard Icon" />
              <span>Leaderboard</span>
            </a>
            <a href="#" class="flex items-center space-x-4 text-purple-600">
              <img src="assets/img/background/dark.png" width="20px" alt="Dark Mode Icon" />
              <span>Inbox</span>
            </a>
          </nav>
        </div>

        <div class="p-6 space-y-6">
          <a href="settings.php" class="flex items-center space-x-4">
            <img src="assets/img/background/setting.png" width="20px" alt="Settings Icon" />
            <span>Settings</span>
          </a>
          <a href="backend/logout.php" class="flex items-center space-x-4">
            <img src="assets/img/background/logout.png" width="20px" alt="Logout Icon" />
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
              <img src="assets/img/background/search.png" alt="Search Icon" class="absolute left-3 w-4 h-4" />
              <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full" />
            </div>
            <img src="assets/img/background/Bell.png" width="20px" alt="Notification Icon" class="cursor-pointer" />
            <img src="https://via.placeholder.com/40" alt="Profile Icon" class="rounded-full cursor-pointer" />
          </div>
        </header>

        <!-- Chat Section -->
        <section class="max-w-7xl mx-auto py-8">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Chat List -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-6">Chats</h3>

  <!-- Search Bar -->
  <input
        type="text"
        id="search-chat"
        placeholder="Search Chats..."
        class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-purple-500"
    />

    <!-- Chat List -->
    <ul id="chat-list" class="space-y-4">
        <!-- Chats will be dynamically inserted here -->
    </ul>


            </div>

            <div class="col-span-2 bg-white p-6 rounded-lg shadow-md flex flex-col h-[80vh]">
        <!-- Chat Header -->
        <div class="flex items-center space-x-4 border-b pb-4">
            <img id="chat-user-pic" src="https://via.placeholder.com/40" alt="Selected Member DP"
                class="w-12 h-12 rounded-full" />
            <span id="chat-user-name" class="text-lg font-semibold">Select a user</span>
        </div>
        <!-- sender id -->
        <input type="hidden" id="user-session-id" value="<?php echo $_SESSION['user_id']; ?>">
        <!-- Chat Messages Container -->
        <div id="chat-box" class="flex-1 bg-gray-50 p-4 overflow-y-auto border rounded-lg space-y-1">
            <!-- Messages will be dynamically loaded here -->
        </div>

        <!-- Input Box -->
        <div class="mt-4 flex items-center border-t pt-4">
            <input id="message-input" type="text" placeholder="Type your message..." 
                class="flex-1 border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" />
            <button id="send-btn"
                class="bg-purple-500 text-white px-6 py-2 rounded-r-lg hover:bg-purple-600 transition">Send</button>
        </div>
    </div>

          </div>
        </section>
      </main>
    </div>

    <!-- Chat JS -->
    <script src="script/chat.js"></script>
  </body>
</html>
