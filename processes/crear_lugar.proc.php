<?php
include '../services/connection.php';
include '../services/reserva.php';

$nombre=$_POST['nombre'];
$perfil=$_POST['perfil'];
$imagen=$_POST['imagen'];

try{
    $stmt = $pdo->prepare("SELECT * FROM tbl_lugar  
    WHERE nom_lugar=? AND fk_id_tipo_lugar=?");
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $perfil);
    $stmt->execute();
    $num_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e) {
    echo $e->getMessage();
}

if(!$num_rows == 1){
    try{
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("INSERT INTO tbl_lugar (nom_lugar, fk_id_tipo_lugar, img_lugar) 
        VALUES (?, ?, ?)");
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $perfil);
        $stmt->bindParam(3, $imagen);
        $stmt->execute();

        header('Location: ../view/administrar_lugares.php');
        $pdo->commit();
    }catch (PDOException $e) {
        $pdo->rollBack();
        echo $e->getMessage();
    }
}else{
    header('Location: ../view/crear_lugar.php?error=error');
}