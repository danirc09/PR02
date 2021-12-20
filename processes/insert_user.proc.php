<?php
ob_start();
include '../services/connection.php';
include '../services/reserva.php';

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$email=$_POST['email'];
$pwd=$_POST['password'];
$perfil=$_POST['perfil'];
/*Comprobamos que elusuario no existe*/

try{
    $pdo->beginTransaction();
    $stmt_usr = $pdo->prepare("SELECT * FROM tbl_usuario WHERE correo_usuario=?");
    $stmt_usr->bindParam(1, $email);
    $stmt_usr->execute();
    $num_rows_usr = $stmt_usr->fetchAll(PDO::FETCH_ASSOC);
    $pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}

if(!$num_rows_usr == 1){
    try{
        $pdo->beginTransaction();
        /*Si el usuario no existe lo creamos y lo inscribimos en el evento*/
        $pwd_encriptada = MD5($pwd);
        $stmt = $pdo->prepare("INSERT INTO tbl_usuario (nom_usuario, apellido_usuario, correo_usuario, contra_usuario, id_perfil_usuario) 
        VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $apellido);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $pwd);
        $stmt->bindParam(5, $perfil);
        // Excecute
        $stmt->execute();
        header('Location: ../view/administrar_usuarios.php');
        ob_end_flush();
        $pdo->commit();
    }catch (PDOException $e) {
        $pdo->rollBack();
        echo $e->getMessage();
    }
}else{
    header('Location: ../view/crear_user.php?error=error');
    ob_end_flush();
}