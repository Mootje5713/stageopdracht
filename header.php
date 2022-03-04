<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="charts.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="layout">
        <div class="topbar">
            <div class="logo">
                <a href="index.php"> 
                <img src="logo.jpg"></a></div>
            <div class="loginstatus">
                <?php echo $_SESSION['username']; ?>
                &nbsp;
                <a href="logout.php">logout</a>
            </div>
        </div>