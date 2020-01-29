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





function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

$db = mysqli_connect('localhost:3306', 'kaitkait', 'password', 'horses3');
$username = $_SESSION['username'];
    $SQLstring = "SELECT id from Horses3.registeredUsers WHERE username = '$username';";
    echo $SQLstring;
    $result = mysqli_query($db, $SQLstring);
    while ($row = $result->fetch_assoc()) {
    $account_id =  $row['id'];
        }

if(!$db){
    echo "error connecting";
}
else{
    echo "connected!";
    if(isset($_POST['submit'])){
    $horseName = mysqli_real_escape_string($db, $_POST['horseName']);;
    $horseOwner = mysqli_real_escape_string($db, $_POST['horseOwner']);
    $horseYOB = mysqli_real_escape_string($db, $_POST['horseYOB']);
    $horseHeight = mysqli_real_escape_string($db, $_POST['horseHeight']);
    $horseType = mysqli_real_escape_string($db, $_POST['horseType']);
    echo $horseType;
    $horseColor = mysqli_real_escape_string($db, $_POST['horseColor']);
    $query = "INSERT INTO Horses3.Horse_info (Horse_Name, Horse_Owner, Horse_YOB, Horse_Type, Horse_is_Member, Horse_Color, account_id) VALUES ('$horseName', '$horseOwner', $horseYOB, '$horseType', 'FALSE', '$horseColor', $account_id)";
    echo $query;
    mysqli_query($db, $query);
    
}

}


$_SESSION['horseName'] = $horseName;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add A New Horse</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<div class="header">
    <h2>Horse Home Page</h2>
</div>
<div class="content">

        <h4> Successfully added new member: <?php echo $_SESSION['horseName'];?> </h4>
        <button class = "button" onclick="location.href='loginHomePage.php'"> Home</button>

        <p> <a href="loginHomePage.php?logout='1'" style="color: red;">logout</a> </p>
</div>

</body>
</center>
</html>

