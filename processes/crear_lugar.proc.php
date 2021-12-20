<?php
ob_start();
include '../services/connection.php';
include '../services/reserva.php';

$nombre=$_POST['nombre'];
$perfil=$_POST['perfil'];

foreach ($_FILES['imagen']["error"] as $key => $error) {
    try{
        $pdo->beginTransaction();
        if($error == UPLOAD_ERR_OK){ 
            $tmp_name = $_FILES['imagen']["tmp_name"][$key];
            $name = basename($_FILES['imagen']["name"][$key]);
            move_uploaded_file($tmp_name, "../img/$name");
        }
        $pdo->commit();
    }catch(PDOException $e) {
        $pdo->rollBack();
        echo $e->getMessage();
    }
}

try{
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("SELECT * FROM tbl_lugar  
    WHERE nom_lugar=? AND fk_id_tipo_lugar=?");
    $stmt->bindParam(1, $nombre);
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
        $stmt = $pdo->prepare("INSERT INTO tbl_lugar (nom_lugar, fk_id_tipo_lugar, img_lugar) 
        VALUES (?, ?, ?)");
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $perfil);
        $stmt->bindParam(3, $name);
        $stmt->execute();

        header('Location: ../view/administrar_lugares.php?exito=exito');
        ob_end_flush();
        $pdo->commit();
    }catch (PDOException $e) {
        $pdo->rollBack();
        echo $e->getMessage();
    }
}else{
    header('Location: ../view/crear_lugar.php?error=error');
    ob_end_flush();
}