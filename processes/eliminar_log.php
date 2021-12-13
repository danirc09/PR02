<?php

require_once '../services/config.php';
require_once '../services/connection.php';

$id=$_POST['id'];

$result = mysqli_query($conn,"DELETE FROM tbl_fecha
WHERE id_fecha = $id");

$nuevaURL = "../view/inicio.php";
header('Location: '.$nuevaURL);

?>