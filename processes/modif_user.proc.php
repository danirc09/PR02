<?php
ob_start();
include '../services/connection.php';
include '../services/reserva.php';

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$email=$_POST['email'];
$id=$_POST['id_usr'];

try{
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("UPDATE tbl_usuario SET nom_usuario=?, apellido_usuario=?, correo_usuario=?
    WHERE id=?");
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $apellido);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $id);
    $stmt->execute();
    
    header('Location: ../view/administrar_usuarios.php');
    ob_end_flush();
    $pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}