<?php
    include "connection.php";
    if (isset($_POST['username']) && ($_POST['wachtwoord'])) {
        $username =  $_POST['username'];
        $password =  $_POST['wachtwoord'];
        $query = "SELECT * FROM `user` WHERE username = '$username' 
        AND wachtwoord = '$password'";
        $result=$conn->query($query);
        if ( $result === FALSE) {
            echo "error" . $query . "<br />" . $conn->error;
        } else {
            if ($result->num_rows>0) {
                while($row=$result->fetch_assoc())
                {
                    $_SESSION["user_id"]=$row['id'];
                    $_SESSION["username"]=$row['username'];
                }
            }
        }
    }
    if (isset($_SESSION['user_id'])) {
        header("Location: index.php");
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
    <form method="POST">
        username <input type="text" name="username" id="username" required>
        <br>
        password <input type="password" name="wachtwoord" id="wachtwoord" required>
        <br>
        nog geen account <a href="register.php">klik hier</a>

        <input type="submit" name="submit" value="sign in">
        </form>

</body>
</html>