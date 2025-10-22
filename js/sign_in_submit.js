document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const data = new FormData();
    data.append('email', email);
    data.append('password', password);

    fetch('/handlers/login.php', {
      method: 'POST',
      body: data,
    })
      .then(res => res.json())
      .then(json => {
        if (json.status === 'success') {
          window.location.href = json.redirect || '/pages/Homepage.php';
        } else {
          alert(json.message || 'Login failed');
        }
      })
      .catch(err => {
        console.error(err);
        alert('An error occurred during login');
      });
  });
});
