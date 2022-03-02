<?php
    include "connection.php";
    if (isset($_GET['domain'])) {
        $domain =  $_GET['domain'];
        $user_id =  $_GET['user_id'];
        $domain = "INSERT INTO `domain` (domainname, user_id)
        VALUES ('$domain', '$user_id')";
    if ($conn->query($domain) === FALSE) {
        echo "error" . $domain . "<br />" . $conn->error;
    } else {
        header("Location: index.php");
    }
    
    }
    $conn->close();
?>

<?php include "header.php"; ?>

<form action="" method="GET">
        <input type="hidden" value="<?php echo $_SESSION['user_id'];?>" 
        name="user_id" id="user_id" required>
        domain <input type="text" name="domain" id="domain" required>
        <br>
        <input type="submit" name="submit" value="Send">
        <br>
        </form>
</body>
</html>
<?php include "footer.php"; ?>