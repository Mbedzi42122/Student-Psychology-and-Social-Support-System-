const menuItems = document.querySelectorAll(".menu-item");
const contentArea = document.getElementById("content-area");

menuItems.forEach(item => {
  item.addEventListener("click", () => {

    // ignore logout (for now)
    if (item.classList.contains("logout")) return;

    // remove active
    menuItems.forEach(i => i.classList.remove("active"));

    // add active
    item.classList.add("active");

    const page = item.getAttribute("data-page");

    // change content
    if (page === "updates") {
      contentArea.innerHTML = `
        <h1>Welcome Student</h1>
        <p>This is your dashboard. Updates will appear here.</p>
      `;
    }

    if (page === "chat") {
      contentArea.innerHTML = `
        <h1>AI Chat</h1>
        <p>Chat with the AI assistant.</p>
      `;
    }

    if (page === "counselling") {
      contentArea.innerHTML = `
        <h1>Request Counselling</h1>
        <p>Book a session with a counselor.</p>
      `;
    }

    if (page === "forum") {
      contentArea.innerHTML = `
        <h1>Peer Forum</h1>
        <p>Talk with other students.</p>
      `;
    }

    if (page === "resources") {
      contentArea.innerHTML = `
        <h1>Resources</h1>
        <p>Access helpful materials.</p>
      `;
    }

    if (page === "settings") {
      contentArea.innerHTML = `
        <h1>Settings</h1>
        <p>Update your account settings.</p>
      `;
    }

  });
});