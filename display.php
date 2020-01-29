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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Horse</title>

    <link rel="stylesheet" type="text/css" href="style.css">



</head>
<body>
<div class="header">
    <h2>Member Home Page</h2>
</div>
<div class="content">

    <button class = "button" onclick="location.href='loginHomePage.php'">Home</button>

    <h2> Members </h2>
    <table id = "members">
        <tr>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Payment Stauts</th>
            <!-- <th> Pay Now? </th> -->
        </tr>

        <?php
        $db = mysqli_connect('localhost:3306', 'kaitkait', 'password', 'Horses3');
        $username = $_SESSION['username'];
        $SQLstring = "SELECT id from Horses3.registeredUsers WHERE username = '$username';";
        //echo $SQLstring;
        $result = mysqli_query($db, $SQLstring);
        while ($row = $result->fetch_assoc()) {
            $current_account_id =  $row['id'];
        }

        // $get_owner_id_query = "SELECT login_id from Horses3.registeredUsers WHERE username = '$username';";
        // $owner_id_query_result = $db->query($get_owner_id_query);

        // if($owner_id_query_result->num_rows > 0)
        // {
        //     while ($row = $owner_id_query_result->fetch_assoc()) {
        //         $owner_id = $row['login_id'];
        //     }
        // }

        $sql = "SELECT first_name, last_name, paymentStatus from Horses3.members_info WHERE account_id = $current_account_id";
        
        $result = $db->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // if($row['paymentStatus'] == 'FALSE') {
                //     $pay_status = 'No';
                // }
                // else {
                //     $pay_status = 'Yes';
                // }
                // }


//                    echo "<tr><td>" . $row["firstName"]. "</td><td>" . $row["lastName"] . "</td><td>" . $row["paymentStatus"] . "</td></tr>";
//                      echo "</td><td>" . $row["lastName"] . "</td><td>" . $pay_status . "</td></tr>";

                echo "<tr>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['paymentStatus'] . "</td>";
                //echo "<td>" . "Pay Now" . "</td>";
                echo "</tr>";

        //    }
            echo "</table";
        }
        }
        else {
            echo("0 results");
        }
        ?>


    </table>
    <br>To Pay for Unpaid Members, <a href="pay.html">Click Here!</a><br><br>
    <h2> Horses </h2>
    <table id = "members">
        <tr>
            <th> Horse Name </th>
            <th> Owner Name </th>
            <th> Coggins </th>
        </tr>

        <?php
        $db = mysqli_connect('localhost:3306', 'root', 'Kaitlyn@98', 'Horses3');
        $username = $_SESSION['username'];
        $SQLstring = "SELECT id from Horses3.registeredUsers WHERE username = '$username';";
        //echo $SQLstring;
        $result = mysqli_query($db, $SQLstring);
        while ($row = $result->fetch_assoc()) {
            $current_account_id =  $row['id'];
        }

        // $get_owner_id_query = "SELECT login_id from Horses3.registeredUsers WHERE username = '$username';";
        // $owner_id_query_result = $db->query($get_owner_id_query);

        // if($owner_id_query_result->num_rows > 0)
        // {
        //     while ($row = $owner_id_query_result->fetch_assoc()) {
        //         $owner_id = $row['login_id'];
        //     }
        // }

        //$sql = "SELECT * from Horses3.horse;";
         $sql = "SELECT Horse_Name, Horse_Owner from Horses3.horse_info WHERE account_id = $current_account_id";
         //echo $sql;
        $result = $db->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // if($row['paymentStatus'] == 'FALSE') {
                //     $pay_status = 'No';
                // }
                // else {
                //     $pay_status = 'Yes';
                // }
                // }


//                    echo "<tr><td>" . $row["firstName"]. "</td><td>" . $row["lastName"] . "</td><td>" . $row["paymentStatus"] . "</td></tr>";
//                      echo "</td><td>" . $row["lastName"] . "</td><td>" . $pay_status . "</td></tr>";

                echo "<tr>";
                echo "<td>" . $row['Horse_Name'] . "</td>";
                echo "<td>" . $row['Horse_Owner'] . "</td>";
                echo "<td>" . "Needs Coggins" . "</td>";
                //echo "<td>" . <a href = "pay.html"> "Pay Now" . "</td>";
                //echo "<td>" . $row['paymentStatus'] . "</td>";

                echo "</tr>";
                //</tr>;

        //    }
            echo "</table";
        }
        }
        else {
            echo("0 results");
        }

        ?>


    </table>
   
    <br>To Pay for Unpaid Horses, <a href="pay.html">Click Here!</a><br><br>

    <p> <a href="loginHomePage.php?logout='1'" style="color: red;">logout</a> </p>

</div>




</body>
</html>