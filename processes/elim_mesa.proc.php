<?php
ob_start();
include '../services/connection.php';
include '../services/reserva.php';

$id=$_GET['id'];

try{
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("DELETE FROM tbl_mesa WHERE id_mesa=?");
    $stmt->bindParam(1, $id);
    if($stmt->execute()){
        header('Location: ../view/administrar_lugares.php');
    }else{
        header('Location: ../view/administrar_lugares.php?error2');
    }     
    
    ob_end_flush();
    $pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}