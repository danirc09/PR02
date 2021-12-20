<?php
ob_start();
include '../services/connection.php';
include '../services/reserva.php';

$id_lugar=$_POST['id_lugar'];
$id_mesa=$_POST['id_mesa'];
$estado=$_POST['estado'];
$sillas=$_POST['sillas'];

try{
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("UPDATE tbl_mesa SET estado_mesa=?, num_sillas_mesa=?
    WHERE id_mesa=? AND id_lugar=?");
    $stmt->bindParam(1, $estado);
    $stmt->bindParam(2, $sillas);
    $stmt->bindParam(3, $id_mesa);
    $stmt->bindParam(4, $id_lugar);
    $stmt->execute();
    
    header('Location: ../view/administrar_lugares.php');
    ob_end_flush();
    $pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}