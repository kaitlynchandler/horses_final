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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add A New Member</title>
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

        <a href="add_member_tester.html" class="linkDesign">Add Member</a> <br><br>
        <a href="add_horse.html" class="linkDesign">Add Horse</a> <br><br>
        <a href="display.php" class="linkDesign">View Members and Horses on Account</a> <br><br>
        <a href="pay.html" class="linkDesign">Register for Show</a> <br><br>



    <?php endif ?>
    <p> <a href="loginHomePage.php?logout='1'" style="color: red;">logout</a> </p>


</div>

</body>
</center>
</html>