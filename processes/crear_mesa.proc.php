<?php
ob_start();
include '../services/connection.php';
include '../services/reserva.php';

$numero=$_POST['numero'];
$perfil=$_POST['perfil'];
$estado=$_POST['estado'];
$sillas=$_POST['sillas'];

try{
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("SELECT * FROM tbl_mesa 
    WHERE numero_mesa=? AND id_lugar=?");
    $stmt->bindParam(1, $numero);
    $stmt->bindParam(2, $perfil);
    $stmt->execute();
    $num_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}

if(!$num_rows == 1){
    try{
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("INSERT INTO tbl_mesa (numero_mesa, id_lugar, estado_mesa, num_sillas_mesa) 
        VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $numero);
        $stmt->bindParam(2, $perfil);
        $stmt->bindParam(3, $estado);
        $stmt->bindParam(4, $sillas);
        $stmt->execute();

        header('Location: ../view/administrar_lugares.php');
        ob_end_flush();
        $pdo->commit();
    }catch (PDOException $e) {
        $pdo->rollBack();
        echo $e->getMessage();
    }
}else{
    header('Location: ../view/crear_mesa.php?error=error');
    ob_end_flush();
}