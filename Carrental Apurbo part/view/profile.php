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

if (isset($_POST['deleteAccount'])) {
   
    $user_id = $user_data['user_id'];
    $query = "DELETE FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);

    if ($result) 
    {
        
        session_destroy();
        header("Location: ../view/login.php");
        exit;
    } 
    
    else 
    {
       
        $deleteErrorMessage = "Failed to delete account. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
  
</head>
<body>
    <center>
        <h1>Welcome, <?php echo $user_data['user_name'] ?></h1>

        <form action="../view/logout.php" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
        
        <h2>Profile Information</h2>
        <p>User Name: <?php echo $user_data['user_name']; ?></p>
        <p>Email: <?php echo $user_data['email']; ?></p>
        <p>Password: <?php echo $user_data['password']; ?></p>

        <form action="" method="post">
            <button type="submit" name="deleteAccount">Delete Account</button>
        </form>

        <?php if (isset($deleteErrorMessage)): ?>
            <p style="color: red;"><?php echo $deleteErrorMessage; ?></p>
        <?php endif; ?>
    </center>
</body>
</html>
