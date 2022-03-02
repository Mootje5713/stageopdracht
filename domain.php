<?php
    include "connection.php";    

    $id = intval($_GET['id']);

    $query = "SELECT * FROM `score` WHERE domain_id=$id ORDER BY id ASC";
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
            <a href="index.php">Home</a> >
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

<table class="charts-css column show-4-secondary-axes" style="height: 200px;">
    <caption> Performance score </caption> 
    <tbody>
        <?php foreach ($scores as $row):?>
            <tr style="--color: <?php if($row['score']<50) echo "red"; else echo "gray"; ?>;">
                <th scope="row">date</th>
                <td style="--size:<?php echo $row['score']/100; ?>;"><?php echo $row['score']; ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
van 13-1 tot 2-3-2022

<table class="charts-css column show-4-secondary-axes" style="height: 200px;">
    <caption> Performance score </caption> 
    <tbody>
        <?php foreach ($scores as $row):?>
            <tr style="--color: <?php if($row['speed']<50) echo "red"; else echo "gray"; ?>;">
                <th scope="row">date</th>
                <td style="--size:<?php echo $row['speed']/10000; ?>;"><?php echo $row['score']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
van 13-1 tot 2-3-2022

<!-- alle speed index waarden -->

<table class="charts-css column show-4-secondary-axes" style="height: 200px;">
    <caption> Performance score </caption> 
    <tbody>
        <?php foreach ($scores as $row):?>
            <tr style="--color: <?php if($row['tti']<50) echo "red"; else echo "gray"; ?>;">
                <th scope="row">date</th>
                <td style="--size:<?php echo $row['tti']/10000; ?>;"><?php echo $row['score']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>

van 13-1 tot 2-3-2022


<table class="charts-css column show-4-secondary-axes" style="height: 200px;">
    <caption> Performance score </caption> 
    <tbody>
        <?php foreach ($scores as $row):?>
            <tr style="--color: <?php if($row['fcp']<50) echo "red"; else echo "gray"; ?>;">
                <th scope="row">date</th>
                <td style="--size:<?php echo $row['fcp']/10000; ?>;"><?php echo $row['score']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>


van 13-1 tot 2-3-2022

    <?php include "footer.php"; ?>
    