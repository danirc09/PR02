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

    $stmt3 = $pdo->prepare("SELECT id_mesa FROM tbl_mesa WHERE id_lugar=?");
    $stmt3->bindParam(1, $id);
    $stmt3->execute();
    $id_mesa = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    $id_mesa = $id_mesa[0]['id_mesa'];

    $stmt4 = $pdo->prepare("DELETE FROM tbl_reserva WHERE id_mesa=?");
    $stmt4->bindParam(1, $id_mesa);


    if($stmt4->execute()){
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
    }else{
        header('Location: ../view/administrar_lugares.php?error');
            ob_end_flush();
    }
    
    $pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}