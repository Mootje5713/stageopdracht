<?php
    include "connection.php";
    if(isset($_POST['username']) && ($_POST['wachtwoord'])) {
        $username =  $_POST['username'];
        $password =  $_POST['wachtwoord'];
        $user = "INSERT INTO `user`(username, wachtwoord)
        VALUES ('$username', '$password')";
        header("location: login.php");
        if ( $conn->query($user) === FALSE) {
            echo "error" . $user . "<br />" . $conn->error;
        } else {
    }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        username <input type="text" name="username" id="username" required>
        <br>
        password <input type="password" name="wachtwoord" id="wachtwoord" required>
        <br>
        <input type="submit" name="submit" value="sign up">
        </form>
</body>
</html>
