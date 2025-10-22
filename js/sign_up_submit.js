document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('registerForm');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const data = new FormData();
    data.append('name', name);
    data.append('email', email);
    data.append('password', password);

    fetch('/handlers/register.php', {
      method: 'POST',
      body: data,
    })
      .then(res => res.json())
      .then(json => {
        if (json.status === 'success') {
          alert('Registration successful. You can now sign in.');
          window.location.href = '/pages/sign-in.php';
        } else {
          alert(json.message || 'Registration failed');
        }
      })
      .catch(err => {
        console.error(err);
        alert('An error occurred during registration');
      });
  });
});
