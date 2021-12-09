<?php
include 'config.php';

$servidor = "mysql: host=".SERVIDOR."; dbname=".BD;

try{
$pdo= new PDO($servidor,USUARIO,PASSWORD);
//echo "<script>alert('Conexion establecida')</script>";
}
catch(PDOException $e){
    //Si escribimos solo Exception podemos coger cualquier error
    echo $e->getMessage();
}