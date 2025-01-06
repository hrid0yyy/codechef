
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="script/chathead.js"></script>
    <link rel="icon" type="image/x-icon" href="assets/img/background/fav-logo.png">
    <title>CodeCraft User Profile</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap");
        * {
            font-family: "Syne", serif;
            font-optical-sizing: auto;
            font-style: normal;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen font-sans p-8">
    
    <!-- Header -->
    <header class="flex justify-between items-center mb-8">
        <button onclick="history.back()" class="bg-gray-200 px-4 py-2 rounded-lg shadow hover:bg-gray-300 transition">⬅ Back</button>
        <h1 class="text-3xl font-bold text-gray-800">User Profile</h1>
        <div class="flex items-center space-x-4">
    <img id="chatIcon"
         src="assets/img/background/chat.png" 
         width="30px" 
         alt="Chat Icon" 
         class="cursor-pointer">
</div>

    </header>

    <!-- Profile Section -->
    <div class="rounded-lg p-8 bg-white shadow-2xl space-y-6 mx-auto max-w-3xl">
        <!-- Cover Picture and Profile Picture -->
        <div class="relative">
            <img src="assets/img/background/rb_9814.png" alt="Cover Picture" class="w-full h-56 object-cover rounded-t-lg">
            <div class="absolute -bottom-16 left-8">
                <img id="profilePicture" src="assets/img/default-profile.png" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-white shadow-xl">
            </div>
        </div>

        <!-- Name, Bio, Title -->
        <div class="mt-20 px-8 text-center">
            <h2 id="userName" class="text-3xl font-bold text-gray-900">Loading...</h2>
            <p id="userBio" class="text-gray-600 text-lg">Loading...</p>
        </div>

        <!-- Skills Section -->
        <div class="px-8">
            <h3 class="text-xl font-semibold mb-4">Skills</h3>
            <div id="userSkills" class="flex flex-wrap gap-3 text-gray-600">Loading...</div>
        </div>

        <!-- Problem Solving and Performance Stats -->
        <div class="px-8 grid grid-cols-2 gap-6 mt-8">
            <div class="bg-purple-50 p-6 rounded-lg text-center shadow-md">
                <h4 class="text-lg font-semibold">Problems Solved</h4>
                <p id="totalSolved" class="text-purple-700 text-3xl font-bold">Loading...</p>
            </div>
            <div class="bg-purple-50 p-6 rounded-lg text-center shadow-md">
                <h4 class="text-lg font-semibold">Leaderboard</h4>
                <p id="position" class="text-purple-700 text-3xl font-bold">Loading...</p>
            </div>
        </div>

        <!-- problem the users solved -->
        <div class="px-8 mt-8">
            <h3 class="text-xl font-semibold mb-4">Solved Problems</h3>
            <ul id="solvedProblems" class="space-y-2 text-gray-700 bg-gray-100 p-4 rounded-lg shadow-md">
                <p class="text-gray-500">Loading...</p>
            </ul>
        </div>



        <!-- Social Links -->
        <div class="px-8 mt-8">
            <h3 class="text-xl font-semibold mb-4">Connect</h3>
            <div class="flex items-center space-x-6">
                <a id="linkedinUrl" href="#" class="text-blue-600 text-lg hover:underline">LinkedIn</a>
                <a id="githubUrl" href="#" class="text-gray-800 text-lg hover:underline">GitHub</a>
                <a id="portfolioUrl" href="#" class="text-purple-700 text-lg hover:underline">Portfolio</a>
            </div>
        </div>
    </div>

    <!-- Inbox Modal -->
    <div id="inboxModal" class="fixed bottom-4 right-4 w-96 bg-white shadow-2xl rounded-xl border border-gray-300 p-6 hidden transition-all transform scale-95">
    <div class="flex items-center space-x-4 mb-4">
        <img id="chatPicture" alt="Profile Picture" class="w-14 h-14 rounded-full border-4 border-purple-500 shadow-md">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Chat</h2>
            <p class="text-sm text-gray-500">Active now</p>
        </div>
        <button onclick="closeInboxModal()" class="ml-auto text-gray-500 hover:text-gray-700 transition" title="Close">✖</button>
    </div>
    <div class="chat-messages bg-gray-100 p-4 h-52 overflow-y-auto border rounded-lg space-y-2"></div>
    <div class="mt-4 flex items-center space-x-2">
        <input id="chatMessageInput" type="text" placeholder="Type your message..." class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
        <button id="sendMessageButton" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 shadow-lg transition">Send</button>
    </div>
</div>



    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const email = urlParams.get('email');

        if (email) {
            fetch(`backend/get_user_profile.php?email=${encodeURIComponent(email)}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            const user = data.data;
            document.getElementById("userName").textContent = user.name;
            document.getElementById("userBio").textContent = user.bio || "No bio available";
            document.getElementById("profilePicture").src = user.profilePicture || "assets/img/default-profile.png";
            document.getElementById("chatPicture").src = user.profilePicture || "assets/img/default-profile.png";
            document.getElementById("totalSolved").textContent = user.total_problems_solved || "0";
            document.getElementById("linkedinUrl").href = user.linkedinUrl || "#";
            document.getElementById("githubUrl").href = user.githubUrl || "#";
            document.getElementById("portfolioUrl").href = user.portfolioUrl || "#";
            document.getElementById("position").textContent = "#" + (user.leaderboard_position || "N/A");

            const skillsDiv = document.getElementById("userSkills");
            skillsDiv.innerHTML = user.skills ? user.skills.split(", ").map(skill =>
                `<span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm">${skill}</span>`
            ).join("") : "No skills added yet.";

            const problemsDiv = document.getElementById("solvedProblems");
            problemsDiv.innerHTML = user.solved_problems.length > 0 ? user.solved_problems.map(problem =>
                `<li class='py-2 px-4 bg-white rounded-lg shadow-md'>${problem.problem_title}</li>`
            ).join("") : "<p class='text-gray-500'>No solved problems yet.</p>";

            // 💡 Dynamically set chat button's onclick function with user ID
            document.getElementById("chatIcon").addEventListener("click", () => {
                openInboxModal(user.user_id, user.profilePicture);
            });
        } else {
            alert("User not found!");
        }
    })
    .catch(error => console.error("Error fetching user data:", error));

        }

       
    </script>

   <script>
// Function to close chat modal
function closeInboxModal() {
    document.getElementById("inboxModal").classList.add("hidden"); // Hide modal
}

// Function to close chat modal
function openInboxModal(receiverId, profilePicture) {
    console.log("Opening chat modal with ID:", receiverId); // Debugging log
    window.receiverId = receiverId; // Store receiver ID globally
    document.getElementById("chatPicture").src = profilePicture || "assets/img/default-profile.png"; // Update chat modal profile picture
    document.getElementById("inboxModal").classList.remove("hidden"); // Show modal
    fetchMessages(); // Load previous messages
   
}


document.addEventListener("DOMContentLoaded", () => {
  const chatModal = document.getElementById("inboxModal");
  const messageInput = document.getElementById("chatMessageInput");
  const sendButton = document.getElementById("sendMessageButton");
  const messagesContainer = document.querySelector(".chat-messages");
  let receiverId = null; // Set dynamically when opening chat

  // Fetch chat messages
  function fetchMessages() {
    if (!window.receiverId) {
        console.log("fetchMessages called but receiverId is undefined!");
        return;
    }

    console.log("Fetching messages for ID:", window.receiverId); // Debugging log

    fetch(`backend/chat/get_messages.php?receiver_id=${window.receiverId}`)
      .then(response => response.json())
      .then(data => {
        const messagesContainer = document.querySelector(".chat-messages");
        messagesContainer.innerHTML = "";

        if (data.status === "success") {

            data.messages.forEach((msg) => {
    const messageWrapper = document.createElement("div"); // Wrapper for alignment
    messageWrapper.classList.add("flex", "mb-2"); // Spacing between messages

    const messageDiv = document.createElement("div");
    messageDiv.classList.add(
        "px-4", "py-2", "rounded-lg", "shadow-md", "max-w-[75%]", "text-sm"
    ); // Limits width, makes text smaller

    if (msg.sender_id == window.receiverId) {
        messageWrapper.classList.add("justify-start"); // Align left
        messageDiv.classList.add("bg-gray-300", "text-gray-800", "self-start");
    } else {
        messageWrapper.classList.add("justify-end"); // Align right
        messageDiv.classList.add("bg-purple-500", "text-white", "self-end");
    }

    messageDiv.textContent = msg.message;
    messageWrapper.appendChild(messageDiv);
    messagesContainer.appendChild(messageWrapper);
});

        // Temp solution
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        } else {
          console.log("No messages found.");
        }
      })
      .catch(error => console.error("Error fetching messages:", error));
}


  // Send a message
  sendButton.addEventListener("click", () => {
    const message = messageInput.value.trim();
    if (message && window.receiverId) {
      fetch("backend/chat/send_message.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `receiver_id=${window.receiverId}&message=${encodeURIComponent(
          message
        )}`,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            messageInput.value = "";
            fetchMessages();
          } else {
            alert("Failed to send message.");
          }
        })
        .catch((error) => console.error("Error sending message:", error));
    }
  });

  // Polling for new messages every 5 seconds
  setInterval(fetchMessages, 500);
});

   </script>
</body>
</html>
