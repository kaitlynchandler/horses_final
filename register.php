<?php include('server.php')?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Register</h2>
</div>

<form method="post" action="register.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email">
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="password_2">
    </div>
    <div class = "input-group">
        <input type="checkbox" name="option1" value="member"> Register as a member<br>
        <input type="checkbox" name="option2" value="trainer"> Register as a trainer<br>
        <input type="checkbox" name="option3" value="official"> Register as a horse show official<br>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>

    <p>
        Already a member? <a href="login.php">Sign in</a>

    </p>

</form>
</body>
</html>