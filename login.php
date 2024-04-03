<?php

include 'includes/head.inc.php';

include './config/db.php';
include './logic/auth.php';


// Check if the user is already logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    // Redirect based on the user's role
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {
        header("Location: ./admin/dashboard.php");
    } else {
        header("Location: ./index.php");
    }
    exit; // Ensure the rest of the script is not executed
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $its = trim($_POST["its"]);
    $password = trim($_POST["password"]);

    // Attempt to authenticate the user
    if (authenticateUser($its, $password)) {

        if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {
            header("Location: ./admin/dashboard.php");
        } else {
            header("Location: ./index.php");
        }
    } else {
        $error_msg = "Invalid username or password.";
    }
}
?>

<div class="container mt-5">
    <h1 class="mb-4"><strong>Login in Sabaq Dashboard</strong></h1>
    <form class="form-group" method="post">
        <div class="mb-3">
            <label for="its" class="form-label">ITS</label>
            <input type="text" name="its" required placeholder="Enter ITS" class="form-control form-control-lg" id="its" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" required placeholder="Enter Password" class="form-control form-control-lg" id="password" />
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success btn-lg">
                Login
            </button>
        </div>
        <?php if (isset($error_msg)) : ?>
            <div class="alert alert-danger mt-3"><?php echo $error_msg; ?></div>
        <?php endif; ?>
    </form>
</div>


<?php
include 'includes/footer.inc.php';
