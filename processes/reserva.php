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

if($estado == 0){
    session_start();
    $_SESSION['id_mesa']=$id;
    $_SESSION['id_pag']=$id_pag;
    header('Location: ../view/form_reservas.php?');
}else{
    $fecha = getdate();
    $fecha = $fecha['year']."-".$fecha['mon']."-".$fecha['mday']." ".$fecha['hours'].":".$fecha['minutes'].":".$fecha['seconds'];
    $stmt = $pdo->prepare("UPDATE tbl_reserva r  
    INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
    SET r.fecha_fin_reserva=?, m.estado_mesa=?
    WHERE m.id_mesa = ?");
    $stmt->execute([$fecha,0,$id]);
    header('Location: ../view/reservas.php?id='.$id_pag.'');
}