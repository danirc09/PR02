<?php
ob_start();
$nuevaURL = "./view/login.php";
header('Location: '.$nuevaURL);
ob_end_flush();