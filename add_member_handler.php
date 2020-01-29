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
	$first_name = mysqli_real_escape_string($db, $_POST['firstName']);;
	$last_name = mysqli_real_escape_string($db, $_POST['lastName']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$dob = mysqli_real_escape_string($db, $_POST['dateOfBirth']);
	$phone_number = mysqli_real_escape_string($db, $_POST['phoneNumber']);
	$street_address = mysqli_real_escape_string($db, $_POST['streetAddress']);
	$city = mysqli_real_escape_string($db, $_POST['city']);
	$zipcode = mysqli_real_escape_string($db, $_POST['zipcode']);


	$query = "INSERT INTO horses3.members_info VALUES ('$first_name', '$last_name', '$email', '$dob', '$phone_number', '$street_address', '$city', '$zipcode', 'Unpaid', $account_id)";
    echo $query;
 	mysqli_query($db, $query);

}

}
// $username = $_SESSION['username'];
// $sql = "SELECT login_id from horses3.registeredUsers where username = '$username';";
// $result = $db->query($sql);
// //$use_me_hehe = "";

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         $login_id = $row['login_id'];
//     }
// }


// console_log($login_id);

$names = $first_name . " " . $last_name;
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

