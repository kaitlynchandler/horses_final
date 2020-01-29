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



$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$dob = $_POST["dateOfBirth"];
$phone = $_POST["phoneNumber"];
$streetAddress = $_POST["streetAddress"];
$city = $_POST["city"];
$zipcode = $_POST["zipcode"];


function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

$db = mysqli_connect('localhost', 'root', 'Kaitlyn@98', 'test_database');

$username = $_SESSION['username'];
$sql = "SELECT login_id from test_database.registeredUsers where username = '$username';";
$result = $db->query($sql);
//$use_me_hehe = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $login_id = $row['login_id'];
    }
}


console_log($login_id);
$query = "INSERT INTO test_database.member(ownerID, firstName, lastName, phoneNumber, email, streetName, city, zipcode) VALUES ('$login_id', '$firstName', '$lastName', '$phone', '$email', '$streetAddress', '$city', '$zipcode');";
$exec = $db->query($query);

$names = $firstName . " " . $lastName;
$_SESSION['memberName'] = $names;
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

        <h4> Successfully added new member: <?php echo $_SESSION['memberName'];?> </h4>
        <button class = "button" onclick="location.href='loginHomePage.php'"> Home</button>

        <p> <a href="loginHomePage.php?logout='1'" style="color: red;">logout</a> </p>
</div>

</body>
</center>
</html>

