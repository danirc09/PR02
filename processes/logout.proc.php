<?php
ob_start();
session_start();
session_destroy();
header('Location: ../view/login.php');
ob_end_flush();
?>