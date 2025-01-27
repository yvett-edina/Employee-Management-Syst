<?php

session_start();

include_once("init.php");

// Check if username and password are provided
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM employees WHERE Name='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($username === 'admin' && $password === '0000') {
        header('Location: admin.html');
        exit;
    }

    if(mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if($password === $user['Password']) {
            // Password is correct, set session variables and redirect to dashboard
            $_SESSION['username'] = $user['Name']; // Store username in session
            header('Location: user.html');
            exit;
        } else {
            // Incorrect password
            echo "<script type='text/javascript'>alert('Invalid password!');</script>";
            //alert('Location: login.html?error=invalid_password');
            exit;
        }
    } else {
        // User not found
        header('Location: login.html?error=user_not_found');
        exit;
    }

} else {
    // Redirect to login page if username or password is not provided
    header('Location: login.html');
    exit;
}

?>
