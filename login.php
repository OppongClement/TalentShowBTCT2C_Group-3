<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $file = 'data.json';
    if (file_exists($file)) {
        $users = json_decode(file_get_contents($file), true);
        foreach ($users as $user) {
            if ($user['email'] == $email && $user['password'] == $pass) {
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];   
                $_SESSION['user_status'] = $user['status']; 
                $_SESSION['user_talent'] = $user['talent']; // Added this line to store talent
                header("Location: dashboard.php");
                exit();
            }
        }
    }
    $error = "Invalid credentials!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Talent Show</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <div class="card">
            <strong><h1>Login</h1></strong>
            <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p>Need an account? <a href="register.php">Register</a></p>
            <p><a href="index.html" style="font-size: 0.8rem; color: #777;">Back to Home</a></p>
        </div>
    </div>
</body>
</html>
