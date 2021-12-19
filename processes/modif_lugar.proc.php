<?php
include '../services/connection.php';
include '../services/reserva.php';

$nombre=$_POST['nombre'];
$id=$_POST['id_lugar'];

try{
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("UPDATE tbl_lugar SET nom_lugar=?
    WHERE id_lugar=?");
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $id);
    $stmt->execute();
    
    header('Location: ../view/administrar_lugares.php');
    $pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}