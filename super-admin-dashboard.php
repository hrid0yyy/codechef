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
    <title>Super Admin Dashboard</title>
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
          <div class="text-2xl font-bold text-purple-600 mb-10">
            <img
              src="assets/img/background/logo.png"
              alt="Super Admin Dashboard Logo"
            />
          </div>

          <!-- Menu Links -->
          <nav class="space-y-6">
            <a href="super-admin-dashboard.php" class="flex items-center space-x-4 ">
              <img src="assets/img/background/dashboard-active.png" width="20px" alt="Dashboard Icon" />
              <span>Dashboard</span>
            </a>
            <a href="super-admin-requests.php" class="flex items-center space-x-4 text-purple-600">
              <img src="assets/img/request.png" width="20px" alt="Requests Icon" />
              <span>Admin Requests</span>
            </a>
          </nav>
        </div>

        <div class="p-6 space-y-6">
          <a href="profile.php" class="flex items-center space-x-4">
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
        <header class="flex justify-between items-center mb-8">
          <h1 class="text-2xl font-bold">Super Admin Dashboard</h1>
          <div class="flex items-center space-x-4">
            <div class="relative flex items-center">
              <img src="assets/img/background/search.png" alt="Search Icon" class="absolute left-3 w-4 h-4" />
              <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full" />
            </div>
            <img src="assets/img/background/Bell.png" width="20px" alt="Notification Icon" class="cursor-pointer" />
            <img src="https://via.placeholder.com/40" alt="Profile Icon" class="rounded-full cursor-pointer" />
          </div>
        </header>

        <!-- Admin Requests Section -->
        <div class="bg-white shadow-lg rounded-lg p-6">
          <h2 class="text-lg font-semibold text-purple-600 mb-4">Pending Admin Requests</h2>
          <table class="w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 p-2">Username</th>
            <th class="border border-gray-300 p-2">Email</th>
            <th class="border border-gray-300 p-2">Action</th>
        </tr>
    </thead>
    <tbody id="adminRequests">
        <!-- Data will be populated here -->
    </tbody>
</table>

<script>
// Function to load admin requests dynamically
function loadAdminRequests() {
    fetch("backend/super-admin/fetch_admin_requests.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("adminRequests").innerHTML = data;
        })
        .catch(error => console.error("Error loading requests:", error));
}

// Approve Admin Request
function approveAdmin(username) {
    fetch("backend/super-admin/update_admin_status.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username: username, action: "approve" })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        loadAdminRequests(); // Refresh list
    })
    .catch(error => console.error("Error approving:", error));
}

// Decline Admin Request
function declineAdmin(username) {
    fetch("backend/super-admin/update_admin_status.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username: username, action: "decline" })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        loadAdminRequests(); // Refresh list
    })
    .catch(error => console.error("Error declining:", error));
}

// Load requests on page load
document.addEventListener("DOMContentLoaded", loadAdminRequests);
</script>

        </div>
      </main>
    </div>
  </body>
</html>
