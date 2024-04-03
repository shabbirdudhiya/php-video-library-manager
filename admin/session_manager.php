<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    // Redirect to the login page if not logged in
    header("Location: ../login.php");
    exit;
}

// Function to check if the user has a specific role
function checkUserRole($session_role, $requiredRole)
{
    echo "User role: " . $session_role;
    // Get the user's role from the session
    $userRole = $session_role;
    // Check if the user's role matches the required role
    if ($userRole === $requiredRole) {
        return true;
    } else {
        echo "Access denied. You do not have permission to access this page.";
        exit;
    }
}
