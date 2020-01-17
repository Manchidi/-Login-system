<?php

//starts a new session
session_start();

//includes a database connection
// DATABASE CONNECTION STUFF GOES HERE
include_once("./engine/connection.php");

//catches user/password submitted by html form
$user = $_POST['email'];
$password = $_POST['passcode'];
$error_fill ="";
$error_log ="";

//checks if the html form is filled
if(empty($_POST['email']) || empty($_POST['passcode'])){
    //echo "Fill all the fields!";
    $error_fill = "Fill all the fields!";
}else{

//searches for user and password in the database
$query = "SELECT * FROM Employees WHERE email='{$user}' AND passcode='{$password}'";
$result = sqlsrv_query($conn, $query);  //$conn is your connection in 'connection.php'


$status = "SELECT status FROM Employees";
$rst = sqlsrv_query($conn, $status);

//checks if the search was made
if($result === false){
     die( print_r( sqlsrv_errors(), true));
}

//checks if the search brought some row and if it is one only row
if(sqlsrv_has_rows($result) != 1){
      // echo "User/password not found";
       $error_log=' <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>User/password not found or you are not approved yet!</strong> Check your credentials and try again..
            </div>';
}
else{
//creates sessions
    while($row = sqlsrv_fetch_array($result)){
       $_SESSION['email'] = $row['email'];
       $_SESSION['employeeID'] = $row['employeeID'];
       $_SESSION['f_name'] = $row['f_name'];
       $_SESSION['l_name'] = $row['l_name'];
    }
//redirects user
    //echo " you are now logged in :)";
    header("Location: /welcome.php");
}
}

?> 

<!DOCTYPE html>

<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <base href="http://www.websrv.hages.co.za/" target="_blank"> -->
    <link rel="stylesheet" href="/src/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/src/css/Custom.css" />
    <script src="/src/js/bootstrap/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>    
    <link rel="stylesheet" href="/login.php">

    <title>Login</title>

</head>
<?php 
    echo $error_log; 
?>

<body class="container contain">
    <div class="inputs mt-5 mb-2" style="height: 100%;">
        <div class="enter pt-3">
            <h4 style="color: black">
                <strong>Sign in to your account</strong>
            </h4>
        </div>
        <br>
        <form method="post" name="myform" onsubmit=" return validateform()" action="">
            <div class="enter">
                <label style="text-align: left;color: black">Email</label>
                <input class="input" name="email" type="email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required>
            </div>
            <div class="enter">
                <label style="color: black">Password</label>
                <input class="input" name="passcode" type="password" required>
            </div>
            <!--<div class="">
                    <label style="text-align: left; float: left; color: black"><a style="color: rgb(21, 21, 20);margin-left: 5px" href="">Forgot Password?</a></label>
                </div>-->
            <div class="btn">
                <input type="submit" name="submit" class="login" value="LOG IN">
            </div>
            <div class="enter pb-4">
                <label style="color: black; float: right;">Don't have an account?&nbsp;<a style="color: rgb(21, 21, 20)" href="enrol.html">Sign up here</a></label>
            </div>
        </form>
    </div>

</body>

</html>