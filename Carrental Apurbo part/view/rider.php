<?php
session_start();

include("../controllers/connections.php");
include("../model/functions.php");
$con = connection();
$user_data = check_login($con);

if (!$user_data) {
    header("Location: ../view/login.php");
    die;
}

$cookieName = 'username';
$cookieValue = $user_data['user_name'];
$cookieExpiration = time() + 3600;

setcookie($cookieName, $cookieValue, $cookieExpiration, '/');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rider Page</title>
  
</head>
<body>
    <div class="container">
        <a href="../view/index.php" class="back-button">Back</a>
        <h1>Welcome, <?php echo $user_data['user_name'] ?> (Rider)</h1>
    
        <center>
            <h2>Register Your Vehicle</h2>
            <form action="../model/vehicle_registration.php" method="post" enctype="multipart/form-data">
                <div>
                    <label for="vehicle_name">Vehicle Name:</label>
                    <input type="text" id="vehicle_name" name="vehicle_name" required>
                </div>
                <div>
                    <label for="license_number">License Number:</label>
                    <input type="text" id="license_number" name="license_number" required>
                </div>
                <div>
                    <label for="vehicle_photo">Vehicle Photo (Max 10MB):</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760"> 
                    <input type="file" id="vehicle_photo" name="vehicle_photo" required>
                </div>
                <div>
                    <input type="submit" value="Register Vehicle">
                </div>
            </form>
        </center>

        <div>
            <a href="../view/logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
