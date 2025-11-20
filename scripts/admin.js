document.getElementById("loginForm").addEventListener("submit", function(e) {
  const captcha = document.getElementById("captcha");

  if (!captcha.checked) {
    e.preventDefault();
    alert("Please verify that you are not a robot.");
  }
});
