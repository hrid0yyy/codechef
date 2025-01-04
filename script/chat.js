document.addEventListener("DOMContentLoaded", () => {
  let selectedUserId = null;

  function fetchUsers() {
    fetch("backend/um/fetch_users.php")
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          const chatList = document.getElementById("chat-list");
          chatList.innerHTML = "";
          data.users.forEach((user) => {
            chatList.innerHTML += `
                <li class="flex items-center space-x-4 cursor-pointer p-2 hover:bg-gray-200 rounded-lg transition"
                    onclick="loadChat(${user.user_id}, '${user.name}', '${
              user.profilePicture
            }')">
                  <img src="${
                    user.profilePicture
                  }" class="w-12 h-12 rounded-full" />
                  <div>
                    <h4 class="font-medium text-gray-800">${user.name}</h4>
                    <p class="text-sm text-gray-600 truncate">${
                      user.last_message || "No messages yet"
                    }</p>
                  </div>
                  <span class="ml-auto text-sm text-gray-500">${
                    user.last_message_time || ""
                  }</span>
                </li>`;
          });
        }
      });
  }

  window.loadChat = function (userId, userName, userPic) {
    selectedUserId = userId;
    document.getElementById("chat-user-name").textContent = userName;
    document.getElementById("chat-user-pic").src = userPic;

    fetch(`backend/um/fetch_chats.php?contact_id=${userId}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          const chatBox = document.getElementById("chat-box");
          chatBox.innerHTML = "";

          data.messages.forEach((msg, index) => {
            const isSender = msg.sender_id !== selectedUserId; // True if logged-in user sent the message
            const bubbleColor = isSender
              ? "bg-blue-500 text-white"
              : "bg-gray-300 text-gray-800";
            const alignment = isSender ? "justify-end" : "justify-start";
            const timestamp = new Date(msg.timestamp).toLocaleTimeString([], {
              hour: "2-digit",
              minute: "2-digit",
              hour12: true,
            });

            chatBox.innerHTML += `
                        <div class="flex ${alignment} items-end space-x-2">
                            ${
                              !isSender
                                ? `<img src="${userPic}" class="w-8 h-8 rounded-full self-end" />`
                                : ""
                            }
                            <div class="relative px-4 py-2 rounded-2xl ${bubbleColor} max-w-md shadow-md">
                                <p>${msg.message}</p>
                                
                            </div>
                        </div>
                    `;
          });

          chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to latest message
        }
      })
      .catch((error) => console.error("Chat fetch error:", error));
  };

  document.getElementById("send-btn").addEventListener("click", () => {
    const messageInput = document.getElementById("message-input");
    const message = messageInput.value.trim();
    if (!message || !selectedUserId) return;

    fetch("backend/um/send_message.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ receiver_id: selectedUserId, message }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          // Append the new message to chat UI instantly
          const chatBox = document.getElementById("chat-box");
          chatBox.innerHTML += `
                <div class="flex justify-end">
                    <div class="bg-blue-500 text-white px-4 py-2 rounded-lg max-w-md text-right">
                        ${message}
                    </div>
                </div>
            `;

          chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to latest message
          messageInput.value = ""; // Clear input field

          // Refresh chat in the background
          setTimeout(() => {
            loadChat(
              selectedUserId,
              document.getElementById("chat-user-name").textContent,
              document.getElementById("chat-user-pic").src
            );
          }, 500);
        }
      })
      .catch((error) => {
        console.error("Error sending message:", error);
      });
  });

  fetchUsers();
});
