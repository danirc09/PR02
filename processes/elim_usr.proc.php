<?php
include '../services/connection.php';
include '../services/reserva.php';

$id=$_GET['id'];

try{
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("DELETE FROM tbl_usuario WHERE id=?");
    $stmt->bindParam(1, $id);
    $stmt->execute();
    
    header('Location: ../view/administrar_usuarios.php');
    $pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}