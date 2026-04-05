const menuItems = document.querySelectorAll(".menu-item");
const contentArea = document.getElementById("content-area");

menuItems.forEach(item => {
  item.addEventListener("click", () => {

    if (item.classList.contains("logout")) return;

    menuItems.forEach(i => i.classList.remove("active"));
    item.classList.add("active");

    const page = item.getAttribute("data-page");

    if (page === "updates") {
      contentArea.innerHTML = `
        <h1>Welcome Student</h1>
        <p>This is your dashboard. Updates will appear here.</p>
      `;
    }

    if (page === "chat") {
      contentArea.innerHTML = `
        <div class="chat-container">

          <div class="chat-header">
            <h2>AI Assistant</h2>
          </div>

          <div class="chat-messages" id="chatMessages">
            <div class="message bot">Hello 👋 How can I help you?</div>
          </div>

          <div class="chat-input-area">
            <textarea id="chatInput" placeholder="Type your message..."></textarea>
            <button id="sendBtn">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>

        </div>
      `;

      const sendBtn = document.getElementById("sendBtn");
      const chatInput = document.getElementById("chatInput");
      const chatMessages = document.getElementById("chatMessages");

      sendBtn.addEventListener("click", sendMessage);
      chatInput.addEventListener("input", () => {
        chatInput.style.height = "auto";
        chatInput.style.height = chatInput.scrollHeight + "px";
      });

      chatInput.addEventListener("keypress", function(e) {
        if (e.key === "Enter" && !e.shiftKey) {
          e.preventDefault();
          sendMessage();
        }
      });

      function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;

        const userMsg = document.createElement("div");
        userMsg.classList.add("message", "user");
        userMsg.textContent = message;
        chatMessages.appendChild(userMsg);

        chatInput.value = "";
        chatInput.style.height = "auto";

        const botMsg = document.createElement("div");
        botMsg.classList.add("message", "bot");
        botMsg.textContent = "Thinking...";
        chatMessages.appendChild(botMsg);

        chatMessages.scrollTop = chatMessages.scrollHeight;
      }
    }

    if (page === "counselling") {
      contentArea.innerHTML = `<h1>Request Counselling</h1><p>Book a session with a counselor.</p>`;
    }

    if (page === "forum") {
      contentArea.innerHTML = `<h1>Peer Forum</h1><p>Talk with other students.</p>`;
    }

    if (page === "resources") {
      contentArea.innerHTML = `<h1>Resources</h1><p>Access helpful materials.</p>`;
    }

    if (page === "settings") {
      contentArea.innerHTML = `<h1>Settings</h1><p>Update your account settings.</p>`;
    }

  });
});