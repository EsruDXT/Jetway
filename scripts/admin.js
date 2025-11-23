document.getElementById("loginForm").addEventListener("submit", function(e) {
  const captcha = document.getElementById("captcha");

  if (!captcha.checked) {
    e.preventDefault();
    alert("Please verify that you are not a robot.");
  }
});

document.getElementById("loginForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const username = document.querySelector("input[type='text']").value;
    const password = document.querySelector("input[type='password']").value;
    const captcha = document.getElementById("captcha").checked;

    if (!captcha) {
        alert("Please verify the captcha");
        return;
    }

    // Kirim ke backend
    const response = await fetch("../backend/admin-login-api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password })
    });

    const result = await response.json();

    if (result.status === "success") {
        window.location.href = "/pages/dashboard-analytics.php";
    } else {
        alert("Invalid username or password");
    }
});
