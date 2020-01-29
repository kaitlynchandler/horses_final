<?php
session_start();
$user = "kaitkait";
$pass = "password";
$database= "horses3";
$host = "localhost:3306";
//function console_log( $data ){
//    echo '<script>';
//    echo 'console.log('. json_encode( $data ) .')';
//    echo '</script>';
//}
//$username = "";
//$password = "";
//$email = "";
$errors = array();
//$db = mysqli_connect('mysql516int.manage.myhosting.com', 'u1166845_x_cap', 'CHSA66horses', 'db1166845_x_cap');

$db = mysqli_connect($host, $user, $pass, $database);

if(!$db){
    echo "error connecting";
}
else{
    echo "connected!";
}
// REGISTER USER
if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 =mysqli_real_escape_string($db, $_POST['password_1']);
    //Use password one and two to verify the passwords are the same when typed twice
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    //Validate the form is correctly filled
    if (empty($username)) { array_push($errors, "Username is required");}
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_pus($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match.");
    }
    //Double check user doesnt already exist with given username / email
//    $user_check =  "SELECT * FROM db1166845_x_cap.registeredUsers WHERE username='$username' OR email='$email' LIMIT 1";
    $user_check =  "SELECT * FROM horses3.registeredUsers WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check);
    $user = mysqli_fetch_assoc($result);
    if ($user) { //if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists.");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Email already exists.");
        }
    }
    //Register user if the array has no errors
    if (count($errors) == 0) {
        $password = md5($password_1);
        //"INSERT INTO db1166845_x_cap.registeredUsers (username, email, password) VALUES('$username', '$email', '$password')";
//        $query = "INSERT INTO db1166845_x_cap.registeredUsers (username, email, password) VALUES('$username', '$email', '$password')";
        $query = "INSERT INTO horses3.registeredUsers (username, email, password) VALUES('$username', '$email', '$password')";
        //VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in!";
        header('location: loginHomePage.php');
    }
}
//LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = md5(mysqli_real_escape_string($db, $_POST['password']));
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
//        $password = md5($password);
//        $query = "SELECT * FROM db1166845_x_cap.registeredUsers WHERE username='$username' AND password='$password'";
        $query = "SELECT * from horses3.registeredUsers where username = '$username' AND password = '$password'";
        $results = mysqli_query($db,$query) or die(mysqli_error($db));
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: loginHomePage.php');
        }
        else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>