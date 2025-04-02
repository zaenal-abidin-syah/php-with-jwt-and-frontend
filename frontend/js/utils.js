const apiUrl = "http://localhost:3000";
let jwtToken = localStorage.getItem("JWT-TOKEN") || "";

function showMessage(msg, type = "info") {
  const messages = document.getElementById("messages");
  if (!messages) return;

  const colors = {
    success: "bg-green-100 border-green-400 text-green-700",
    error: "bg-red-100 border-red-400 text-red-700",
    info: "bg-blue-100 border-blue-400 text-blue-700",
  };

  messages.innerHTML = `
    <div class="${colors[type]} border px-4 py-3 rounded relative mb-4" role="alert">
      <span class="block sm:inline">${msg}</span>
    </div>
  `;

  setTimeout(() => {
    messages.innerHTML = "";
  }, 5000);
}

function checkAuth() {
  if (
    !jwtToken &&
    window.location.pathname !== "/login" &&
    window.location.pathname !== "/register"
  ) {
    window.location.href = "/login";
  }
}

function parseJwt(token) {
  try {
    return JSON.parse(atob(token.split(".")[1]));
  } catch (e) {
    return null;
  }
}

// Initialize auth check on page load
document.addEventListener("DOMContentLoaded", checkAuth);
