<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
    include '../services/connection.php';
    try{
        $pdo->beginTransaction();
        $email=$_POST['email'];
        $password=$_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM tbl_usuario WHERE correo_usuario='{$email}' and contra_usuario=MD5('{$password}')");
        $stmt->execute();
        $comprobar=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt2 = $pdo->prepare("SELECT p.perfil_usuario FROM tbl_perfil p INNER JOIN tbl_usuario u ON u.id_perfil_usuario = p.id 
        WHERE u.correo_usuario='{$email}' and u.contra_usuario=MD5('{$password}')");
        $stmt2->execute();
        $perfil=$stmt2->fetchAll(PDO::FETCH_ASSOC);
        //print_r($perfil);
        $nombre = $pdo->prepare("SELECT nom_usuario FROM tbl_usuario WHERE correo_usuario='{$email}'");
        $nombre->execute();
        $nombre_user=$nombre->fetchAll(PDO::FETCH_ASSOC);
        $nom = $nombre_user[0]['nom_usuario'];
        $id = $pdo->prepare("SELECT id FROM tbl_usuario WHERE correo_usuario='{$email}'");
        $id->execute();
        $id_user=$id->fetchAll(PDO::FETCH_ASSOC);
        $pdo->commit(); 
    }catch (PDOException $e) {
        $pdo->rollBack();
        echo $e->getMessage();
    }
    try {
        $pdo->beginTransaction();
        if (!$comprobar == "") {
            if($perfil[0]['perfil_usuario'] == 'Camarero'){
                session_start();
                $_SESSION['nom_user']=$nom;
                header("location: ../view/inicio.php");
            }else{
                session_start();
                $_SESSION['nom_user']=$nom;
                header("location: ../view/zona_admin.php");
            }
        }else {
            session_start();
            $_SESSION['error']=1;
            header("location: ../view/login.php?error=errorlogin");

        }
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo $e->getMessage();
    }
}else{
    header("location: ../view/login.php");
}

