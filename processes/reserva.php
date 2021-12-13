<?php
include '../services/connection.php';
include '../services/reserva.php';

$id = $_GET['id'];
$id_pag = $_GET['id_pag'];
$lugar = $_GET['lugar'];

$stmt= $pdo->prepare("SELECT m.estado_mesa FROM tbl_mesa m
INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
WHERE tl.tipo_lugar = '{$lugar}' AND m.id_mesa = {$id}");
$stmt->execute();
$sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
$estado = $sentencia[0]['estado_mesa'];
echo $estado;

if($estado == 0){
    $stmt = $pdo->prepare("UPDATE tbl_mesa SET estado_mesa=? WHERE id_mesa = ?");
    $stmt->execute([1,$id]);
    header('Location: ../view/reservas.php?id='.$id_pag.'');
}else{
    $stmt = $pdo->prepare("UPDATE tbl_mesa SET estado_mesa=? WHERE id_mesa = ?");
    $stmt->execute([0,$id]);
    header('Location: ../view/reservas.php?id='.$id_pag.'');
}