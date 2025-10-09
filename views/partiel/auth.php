<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../../views/pages/index.php");
    exit();
}
?>
