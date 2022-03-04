<?php
    include "connection.php";
    if (isset($_GET['domain'])) {
        $domain =  $_GET['domain'];
        $domain = "INSERT INTO `domain`(domainname)
        VALUES ('$domain')";
    if ( $conn->query($domain) === FALSE) {
        echo "error" . $domain . "<br />" . $conn->error;

    } else {
    }
}

    $query = "SELECT * FROM `domainswithlastscore` WHERE user_id='".$_SESSION["user_id"]."'";
    $result=$conn->query($query);
    if ( $result === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
    } else {
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc())
            {            
                $domains[] = $row;
            }
        }
    }
    $conn->close();
?>
<?php 
    include "header.php";
?>
        <div class="bar">
            <div class="breadcrumbs">
            <a href="index.php">Home</a>
            </div>
            <div class="cta">
                <a href="adddomain.php">Voeg domain toe</a>
            </div>
        </div>
        <div class="main">

<h1>Domains</h1>
    <ul>
    <?php foreach ($domains as $row):?>
        <li>
            <a href="domain.php?id=<?php echo $row['domain_id']; ?>">
                <?php echo $row['domainname']; ?> - <?php echo $row['score']; ?>

            </a>
        </li>
    <?php endforeach; ?>
    </ul>


    <?php include "footer.php"; ?>
</body>
</html>