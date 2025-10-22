<?php
// handlers/logout.php
session_start();
// Unset all session values
$_SESSION = [];
// Destroy session cookie
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}
session_destroy();

// Redirect to sign-in page
header('Location: /pages/sign-in.html');
exit;

?>
