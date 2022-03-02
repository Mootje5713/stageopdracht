<?php
    include "connection.php";    

    $id = intval($_GET['id']);

    $query = "SELECT * FROM `score` WHERE domain_id=$id ORDER BY id DESC";
    $result=$conn->query($query);
    if ( $result === FALSE) {
        echo "error" . $score . "<br />" . $conn->error;
    } else {
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc())
            {
                $scores[] = $row;
            }
        }
    }

    if (isset($_GET['domain'])) {
        $domain =  $_GET['domain'];
        $domain = "INSERT INTO `domain`(domainname)
        VALUES ('$domain')";
    if ( $conn->query($domain) === FALSE) {
        echo "error" . $domain . "<br />" . $conn->error;

    } else {
    }
    }
    $query = "SELECT * FROM `domain` WHERE id=$id";
    $result=$conn->query($query);
    if ( $result === FALSE) {
        echo "error" . $domain . "<br />" . $conn->error;
    } else {
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc())
            {
                $domains[] = $row;
            }
        }
    }
    


    if (!isset($_GET['id'])) {
        header("Location: index.php");
    }

    $conn->close();
?>
    <?php 
    include "header.php";
    ?>
        <div class="bar">
            <div class="breadcrumbs">
            <a href="index.php">Home > </a>
            <?php foreach ($domains as $row):?><?php echo $row['domainname']; ?><?php endforeach; ?>
            </div>
            <div class="cta">
                <a href="addscore.php?id=<?php echo $_GET['id']; ?>">Voeg score toe</a>
            </div>
        </div>
        <div class="main">



            <?php foreach ($domains as $row):?>

                <h1>
                <?php echo $row['domainname']; ?>
                </h1>
            <?php endforeach; ?>

            

    <?php if (isset($scores)): ?>
        <ul>
            <?php foreach ($scores as $row):?>
                <li>Performance score: <?php echo $row['score']; ?>
                <br>
                speedindex: <?php echo $row['speed']; ?>
                <br>
                firstContentfulPaint: <?php echo $row['fcp']; ?>
                <br>
                time to interactive: <?php echo $row['tti']; ?>
                <br>
                timestamp: <?php echo $row['datum']; ?>
            </li>
                <br>
                
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>


<!-- alle tti waarden  bar colums-->
<table class="charts-css column multiple">
    <tr>
    <th> <?php echo $row['datum']; ?> </th>
    <?php foreach ($scores as $row):?>
        <td><?php echo $row['tti']; ?></td>
    <?php endforeach; ?>
    </tr>
</table>
van 13-1 tot 2-3-2022

<!-- alle speed index waarden -->

<table class="charts-css column multiple">
    <tr>
    <th scope="row"> Label </th>
    <?php foreach ($scores as $row):?>
        <td><?php echo $row['speed']; ?></td> 
    <?php endforeach; ?>
    </tr>
</table>
van 13-1 tot 2-3-2022


    <?php include "footer.php"; ?>
    