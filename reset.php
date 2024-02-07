<?php

//Connecting database
$mysqlite = new mysqli("localhost", "root", "", "user_registration");

//check connection
if($mysqlite == false) {
    die("ERROR: Could not connect. ".$mysqlite->connect_error);
}

//Process registration form
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $mysqlite->real_escape_string($_POST['email']);
    $password = $mysqlite->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE EmailId = '$email'";
    $result = $mysqlite->query($sql);
    if($result->num_rows == 0) {
        echo "Email doesn't exist. ";
        echo "Please Register first";
    } else {
        $sql = "UPDATE users SET Password = '$password' WHERE EmailId = '$email'";
        
        if($mysqlite->query($sql) === true) {
            echo "Reset successful";
        } else {
            echo "ERROR: Could not able to execute. " . $mysqlite->error;
        }
    }
    //close connection
    $mysqlite->close();
}
?>