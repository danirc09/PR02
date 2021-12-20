<?php
ob_start();
include '../services/connection.php';
include '../services/reserva.php';

$id=$_GET['id'];

try{
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("DELETE FROM tbl_lugar WHERE id_lugar=?");
    $stmt->bindParam(1, $id);

    $stmt2 = $pdo->prepare("DELETE FROM tbl_mesa WHERE id_lugar=?");
    $stmt2->bindParam(1, $id);

    if($stmt2->execute()){
        if($stmt->execute()){
            header('Location: ../view/administrar_lugares.php');
            ob_end_flush();
        }else{
            header('Location: ../view/administrar_lugares.php?error');
            ob_end_flush();
        }
    }else{
        header('Location: ../view/administrar_lugares.php?error');
        ob_end_flush();
    }
    
    $pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}