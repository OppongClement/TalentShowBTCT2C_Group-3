<?php
session_start();
if (!isset($_SESSION['user_email'])) { 
    header("Location: login.php"); 
    exit(); 
}

// Retrieve session data
$name = $_SESSION['user_name'] ?? 'ARTIST'; 
$email = $_SESSION['user_email'];
$status = $_SESSION['user_status'] ?? 'Pending';
$talent = $_SESSION['user_talent'] ?? 'Performer';

// Status color: Yellow for pending, Green for accepted
$statusColor = ($status == 'Accepted') ? '#28a745' : '#ffc107'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* The Golden Info Box */
        .profile-card {
            background: rgba(0, 0, 0, 0.6); /* Semi-transparent dark background */
            border: 2px solid #ffd700; /* Solid Gold Border */
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.3); /* Golden Glow */
            padding: 30px;
            border-radius: 15px;
            max-width: 500px;
            margin: 20px auto;
            text-align: center;
        }

        .status-pill {
            background-color: <?php echo $statusColor; ?>;
            padding: 5px 15px;
            border-radius: 50px;
            font-weight: bold;
            display: inline-block;
            color: #000;
            margin-top: 10px;
        }

        .talent-tag {
            color: #ffd700;
            font-weight: bold;
            font-size: 1.4rem;
            display: block;
            margin: 10px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero h1 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header class="hero">
        <h2>WELCOME, <?php echo strtoupper(htmlspecialchars($name)); ?>!</h2>
        
        <!-- The Golden Box Starts Here -->
        <div class="profile-card">
            <p style="color: #bbb; font-size: 0.9rem; margin-bottom: 5px;">OFFICIAL ARTIST PROFILE</p>
            <span class="talent-tag"><?php echo htmlspecialchars($talent); ?></span>
            
            <p style="margin: 15px 0;"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            
            <p>Status: <span class="status-pill"><?php echo htmlspecialchars($status); ?></span></p>
        </div>
        <!-- The Golden Box Ends Here -->

        <div class="btn-container" style="margin-top: 30px;">
            <a href="logout.php" class="btn btn-outline">Logout</a>
        </div>
    </header>
</body>
</html>
