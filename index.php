<?php
// Start the session
session_start();

// Simulate a simple database with users (In production, you'd use a database)
$users = [
    "user1" => "password123",
    "user2" => "password456"
];

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username]) && $users[$username] == $password) {
        // User is authenticated, create a session
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid username or password.";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the homepage
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Glacial+Indifference&display=swap" rel="stylesheet">
    <title>Design&Dine</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <div class="top-nav">
        <div class="nav-container">
            <img src="logo.jpg" alt="Design&Dine Logo" class="logo">
            <nav>
                <a href="gen.php">PLANNING</a>
                <a href="meal_plans.php">SAVED MEAL PLANS</a>
                <a href="about.php">ABOUT</a>
            </nav>
        </div>
    </div>

    <!-- Header Section -->
    <header>
        <div class="call_to_action">
            <p>Get personalized recipes based on what you have at home!</p>
        </div>
        <div class="kiwi-container">
            <img src="kiwi.jpg" alt="Kiwi Image" class="kiwi">
        </div>
        <div class="container">
            <div class="logo-center">
                <img src="logo.jpg" alt="Design&Dine Logo">
            </div>
            <a href="gen.php" class="learn-more-btn">Generate Your Meal Plan</a>
        </div>
    </header>

    <!-- Login/Register Section -->
    <div style="background-color: #333; color: white; text-align: center; padding: 20px;">
        <?php
        if (isset($_SESSION['username'])) {
            // If the user is logged in, display their username and a logout option
            echo "<p>Welcome, " . $_SESSION['username'] . " | <a href='index.php?logout' style='color: #e4d426;'>Logout</a></p>";
        } else {
            // If the user is not logged in, display login and register options
            echo "<p><a href='login.php' style='color: #e4d426; text-decoration: none;'>Login</a> | <a href='register.php' style='color: #e4d426; text-decoration: none;'>Register</a></p>";
        }
        ?>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>Design&Dine ©️ 2024. All rights reserved.</p>
    </footer>

    <!-- Simple Login Form (Only shown when not logged in) -->
    <?php if (!isset($_SESSION['username'])): ?>
    <div id="login-form" style="text-align: center; padding: 20px;">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>