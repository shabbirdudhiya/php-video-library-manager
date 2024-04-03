<?php
include './config/db.php';

function authenticateUser($its, $password)
{
    global $db; // Assuming $db is your PDO database connection

    echo $its;
    echo $password;
    // Prepare a select statement
    $stmt = $db->prepare("SELECT * FROM users WHERE its = :its");
    $stmt->bindParam(':its', $its, PDO::PARAM_STR);

    // Execute the prepared statement
    $stmt->execute();

    // Check if the user exists
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        // Verify the password
        if ($user['password'] == $password) {

            // Password is correct, so start a new session
            session_start();

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user["id"];
            $_SESSION["its"] = $its;
            $_SESSION["role"] = $user["role"];
            $_SESSION["sabaq_group"] = $user["sabaq_group"];

            return true;
        }
    }

    return false;
}
