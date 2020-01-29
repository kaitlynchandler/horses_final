<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first.";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}


$firstName = "";
$lastName = "";
$dob = "";
$phone = "";
$email = "";
$streetName = "";
$city = "";
$zip = "";
$pleaseWork = "";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
    <h2>Member Home Page</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>

        <button class = "button" onclick="location.href='loginHomePage.php'"> Go Back </button>

        <form action ="add_member_handler.php" method ="get">
            First Name: <input type ="text" name="firstName"> <br>

            E-mail : <input type="text" name="email"><br>
            <input type = "submit">
        </form>


        <p> <a href="loginHomePage.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>

</body>
</html>

