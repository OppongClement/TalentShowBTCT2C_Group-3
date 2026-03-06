<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['fullname']; 
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    // Check if "Others" was selected and use the custom input if it was
    $talent = ($_POST['talent'] == 'Others' && !empty($_POST['other_talent'])) 
              ? $_POST['other_talent'] 
              : $_POST['talent'];

    $status = "Pending"; 
    $file = 'data.json';
    
    if (!file_exists($file)) { file_put_contents($file, json_encode([])); }
    $current_data = json_decode(file_get_contents($file), true);
    
    $current_data[] = array(
        'name' => $name, 
        'email' => $email, 
        'password' => $pass, 
        'talent' => $talent, 
        'status' => $status
    );
    
    file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT));
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Talent Registration</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Shows the extra input box ONLY when "Others" is selected
        function checkTalent(val) {
            const otherInput = document.getElementById('other_talent_input');
            otherInput.style.display = (val === 'Others') ? 'block' : 'none';
            if (val !== 'Others') { document.getElementById('other_field').value = ''; }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <div class="card">
            <h2>Talent Registration</h2>
            <form method="POST">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                
                <select name="talent" onchange="checkTalent(this.value)" required style="width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; background: #f0f4ff;">
                    <option value="" disabled selected>Select Your Talent</option>
                    <option value="Magic">Magic</option>
                    <option value="Singing">Singing</option>
                    <option value="Dancing">Dancing</option>
                    <option value="Drumming">Drumming</option>
                    <option value="Painting">Painting</option>
                    <option value="Others">Others</option>
                </select>

                <!-- Hidden by default, shown via JavaScript -->
                <div id="other_talent_input" style="display:none;">
                    <input type="text" id="other_field" name="other_talent" placeholder="Enter your specific talent">
                </div>

                <button type="submit">Sign Up</button>
            </form>
            <p>Already registered? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
