<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jetway - Admin Login</title>
  <link rel="stylesheet" href="/styles/admin.css">

  <!-- Google Icons (optional) -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>

  <div class="container">
    <h1>LOGIN</h1>
    <p class="subtitle">Login as an Admin User</p>

    <form id="loginForm">
      <div class="input-box">
        <span class="material-icons">mail</span>
        <input type="text" placeholder="Username" required>
      </div>

      <div class="input-box">
        <span class="material-icons">lock</span>
        <input type="password" placeholder="Password" required>
      </div>

      <!-- Dummy reCAPTCHA -->
      <div class="captcha-box">
        <input type="checkbox" id="captcha">
        <label for="captcha">I'm not a robot</label>
        <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" class="captcha-img">
      </div>

      <button type="submit" class="btn">Confirm</button>
    </form>
  </div>

  <script src="/scripts/admin.js"></script>
</body>
</html>
