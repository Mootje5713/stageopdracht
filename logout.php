<?php
include "connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_destroy();
    header('location: login.php');
}
?>