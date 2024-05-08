<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: fetch_data.php");
    exit;
}

$correct_username = "nagender123";
$correct_password = "12345";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    if ($entered_username === $correct_username && $entered_password === $correct_password) {
        $_SESSION['username'] = $correct_username;
        header("Location: fetch_data.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="stylesLo.css">
</head>
<body>
    <div class="login-container">
        <img src="logo.png" alt="GKV Logo" class="logo-image">
        <h2 class="login-heading">ADMIN LOGIN</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="login-form">
            <label for="username" class="form-label">Username:</label>
            <input type="text" id="username" name="username" class="form-input" required><br><br>
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-input" required><br><br>
            <input type="submit" value="Login" class="submit-button">
            <?php if (isset($error)) { ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php } ?>
        </form>
    </div>
</body>
</html>
