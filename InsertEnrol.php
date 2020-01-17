<?php

//includes a database connection
// DATABASE CONNECTION STUFF GOES HERE
include_once("./engine/connection.php");

    $name = $_REQUEST['name'];
    $Lname = $_REQUEST['lastname'];
    $email = $_REQUEST['email'];
    $pass = $_REQUEST['passcode'];
    //$pass = md5($_POST['passcode']);
   // $passW = sha1($pass);
    $cell = $_REQUEST['cellphone'];


if (isset($_POST['submit'])) { // if save button on the form is clicked

    $tsql = "insert into Employees (f_name, l_name, email, passcode, cell_number) 
    values ('$name','$Lname','$email', '$pass', '$cell')";

    //Execute the query. 
    $stmt = sqlsrv_query( $conn, $tsql);  
    
    //Successful registration
     header("Location: /congrats.html");       
}
/* Connection resources. */   

sqlsrv_free_stmt( $stmt);    
sqlsrv_close( $conn);
?>