<?php
session_start();

//Connecting to database
$mysqlite = new mysqli("localhost", "root", "", "user_registration");

if ($mysqlite == false) {
    die("ERROR: Could not connect. ".$mysqlite->connect_error);
}

#processing login form
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $mysqlite->real_escape_string($_POST['email']);
    $password = $mysqlite->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE EmailId = '$email'";
    $result = $mysqlite->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($password == $row['Password']){
            $_SESSION['email'] = $email;
            echo "Login successful";
        } else{
            echo "Invalid password";
        }
    } else{
        echo "User not found";
    }

    $mysqlite->close();
}
?>