<?php
// Start the session to access the session variables
session_start();

// Unset all session variables to clear the session data
$_SESSION = array();

// Check if session cookies are used
if (ini_get("session.use_cookies")) {
    // Retrieve current session cookie parameters
    $params = session_get_cookie_params();

    // Invalidate the session cookie by setting its expiration time in the past
    setcookie(
        session_name(), // Name of the session cookie
        '', // Empty value to erase the cookie content
        time() - 42000, // Set expiration time to 42000 seconds ago
        $params["path"], // Path where the cookie is valid
        $params["domain"], // Domain of the cookie
        $params["secure"], // Whether the cookie should only be sent over secure connections
        $params["httponly"] // Whether the cookie is accessible only through the HTTP protocol
    );
}

// Destroy the session to remove session data from the server
session_destroy();

// Redirect the user to the home page (or login page)
header("Location: index.html");
exit; // Ensure script termination after the redirect
