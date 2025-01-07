document.addEventListener("DOMContentLoaded", function () {
  const chatList = document.getElementById("chat-list");
  const searchInput = document.getElementById("search-chat");
  const chatBox = document.getElementById("chat-box");
  const messageInput = document.getElementById("message-input");
  const sendBtn = document.getElementById("send-btn");
  const userSessionId = parseInt(
    document.getElementById("user-session-id").value
  ); // Get sender ID from session
  let selectedChatPartner = null;
  let firstLoad = true; // ✅ Track if it's the first load

  // ✅ Fetch & display chat list
  async function fetchChats() {
    try {
      const response = await fetch("backend/chat/get_chats.php");
      const chats = await response.json();

      chatList.innerHTML = ""; // Clear existing chats

      chats.forEach((chat) => {
        const options = {
          hour: "numeric",
          minute: "numeric",
          hour12: true,
          day: "numeric",
          month: "short",
        };
        const lastMessageTime = new Date(chat.last_message_time).toLocaleString(
          "en-US",
          options
        );

        const unseenBadge =
          chat.unseen_messages > 0
            ? `<span class="ml-2 text-sm bg-red-500 text-white px-2 py-1 rounded-full">${chat.unseen_messages}</span>`
            : "";

        const chatItem = `
          <li class="flex items-center p-3 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 cursor-pointer" 
              data-id="${chat.chat_partner_id}" 
              data-name="${chat.chat_partner_name}" 
              data-pic="${chat.chat_partner_profile || "default-profile.png"}">
              
            <img src="${
              chat.chat_partner_profile || "default-profile.png"
            }" alt="${chat.chat_partner_name}" class="w-10 h-10 rounded-full">
            <div class="ml-4 flex-1">
              <h3 class="text-lg font-semibold">${chat.chat_partner_name}</h3>
              <p class="text-gray-600 text-sm">${chat.last_message}</p>
            </div>
            <div class="text-xs text-gray-500">${lastMessageTime}</div>
            ${unseenBadge}
          </li>
        `;

        chatList.innerHTML += chatItem;
      });
    } catch (error) {
      console.error("Error fetching chats:", error);
    }
  }

  searchInput.addEventListener("input", function () {
    const searchTerm = searchInput.value.toLowerCase();
    const chatItems = chatList.querySelectorAll("li");

    chatItems.forEach((item) => {
      const chatName = item.getAttribute("data-name").toLowerCase();
      item.style.display = chatName.includes(searchTerm) ? "flex" : "none";
    });
  });

  async function loadMessages() {
    if (!selectedChatPartner) return;

    try {
      const response = await fetch(
        `backend/chat/inbox_get_messages.php?chat_partner=${selectedChatPartner}`
      );
      const messages = await response.json();

      chatBox.innerHTML = ""; // Clear chat box

      messages.forEach((msg) => {
        const isSender = msg.sender_id == userSessionId; // Compare session user ID
        const messageElement = `
          <div class="flex ${isSender ? "justify-end" : "justify-start"}">
            <div class="p-3 rounded-lg max-w-xs ${
              isSender ? "bg-purple-500 text-white" : "bg-gray-200 text-black"
            }">
              ${msg.message}
           
            </div>
          </div>
        `;
        chatBox.innerHTML += messageElement;
      });

      // ✅ Auto-scroll only on first message load
      if (firstLoad) {
        chatBox.scrollTop = chatBox.scrollHeight;
        firstLoad = false; // Disable auto-scroll for subsequent loads
      }
    } catch (error) {
      console.error("Error loading messages:", error);
    }
  }

  // ✅ Send new message
  sendBtn.addEventListener("click", async function () {
    const message = messageInput.value.trim();
    if (!message || !selectedChatPartner) return;

    try {
      const response = await fetch("backend/chat/inbox_send_messages.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `chat_partner=${selectedChatPartner}&message=${encodeURIComponent(
          message
        )}`,
      });

      const result = await response.json();

      if (result.success) {
        messageInput.value = ""; // Clear input field
        loadMessages(); // Reload chat
      }
    } catch (error) {
      console.error("Error sending message:", error);
    }
  });

  chatList.addEventListener("click", function (event) {
    const chatItem = event.target.closest("li");
    if (chatItem) {
      const userId = chatItem.getAttribute("data-id");
      const userName = chatItem.getAttribute("data-name");
      const profilePic = chatItem.getAttribute("data-pic");

      selectedChatPartner = userId;
      document.getElementById("chat-user-name").innerText = userName;
      document.getElementById("chat-user-pic").src = profilePic;

      loadMessages(); // Load chat messages for selected user
    }
  });

  setInterval(loadMessages, 500);
  setInterval(fetchChats, 500);
});
