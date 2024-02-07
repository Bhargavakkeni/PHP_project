<?php

//Connecting database
$mysqlite = new mysqli("localhost", "root", "", "user_registration");

//check connection
if($mysqlite == false) {
    die("ERROR: Could not connect. ".$mysqlite->connect_error);
}

//Process registration form
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $mysqlite->real_escape_string($_POST['name']);
    $emailId = $mysqlite->real_escape_string($_POST['emailId']);
    $password = $mysqlite->real_escape_string($_POST['password']);
    $address = $mysqlite->real_escape_string($_POST['address']);
    $mobile = $mysqlite->real_escape_string($_POST['mobile']);

    $sql = "SELECT * FROM users WHERE EmailId = '$emailId'";
    $result = $mysqlite->query($sql);
    if($result->num_rows > 0) {
        echo "Email already exist";
    } else {
        $sql = "INSERT INTO users (Name, EmailId, Password, Address, Mobile) VALUES ('$name', '$emailId', '$password', '$address','$mobile')";
        
        if($mysqlite->query($sql) === true) {
            echo "Registration successful";
        } else {
            echo "ERROR: Could not able to execute. " . $mysqlite->error;
        }
    }
    //close connection
    $mysqlite->close();
}
?>