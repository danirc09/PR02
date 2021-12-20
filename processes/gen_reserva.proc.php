<?php
ob_start();
include '../services/connection.php';
include '../services/reserva.php';

$id_mesa = $_POST['id_mesa'];
$id_pag = $_POST['id_pag'];
$n_reserva = $_POST['n_reserva'];
$dia = $_POST['txtDate'];
$hora = $_POST['hora'];

$fecha_actual = getdate();
$dia_actual = $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'];
$hora_actual = $fecha_actual['hours'].":".$fecha_actual['minutes'];

try{
    $pdo->beginTransaction();    
    $stmt_id= $pdo->prepare("SELECT id_tipo_lugar FROM tbl_tipo_lugar
    WHERE id_tipo_lugar = '$id_pag'");
    $stmt_id->execute();
    $id_tipo_lugar=$stmt_id->fetchAll(PDO::FETCH_ASSOC);
    foreach($id_tipo_lugar as $row){
        $id_tipo_lugar = $row['id_tipo_lugar'];
    }

    if($dia == $dia_actual && $hora<$hora_actual){
        session_start();
        $_SESSION['error']=1;
        header("location: ../view/form_reservas.php?id={$id_mesa}&id_pag={$id_pag}&error2=error");
        ob_end_flush();
    }else{
        //Creamos fecha de salida
        $fechaentrada	= strtotime ( "2 hours" , strtotime ( $hora ) ) ;
        $fechasalida 	= date ( 'H:i:s' , $fechaentrada );
        //Comprobamos una hora antes
        $fechaentrada2	= strtotime ( "-1 hour" , strtotime ( $hora ) ) ;
        $hora2 	= date ( 'H:i:s' , $fechaentrada2 );
        //Comprobamos una hora después
        $fechaentrada3	= strtotime ( "+1 hour" , strtotime ( $hora ) ) ;
        $hora3 	= date ( 'H:i:s' , $fechaentrada3 );
        
        //consulta para comprobar si hay valores cuando la hora es la introducidad por el cliente
        $stmt= $pdo->prepare("SELECT r.fecha_reserva, r.id_mesa, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva
        FROM tbl_reserva r
        INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
        INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
        INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
        WHERE tl.id_tipo_lugar = '$id_tipo_lugar' AND r.id_mesa = '$id_mesa' AND r.fecha_reserva = '$dia' AND r.fecha_ini_reserva = '$hora'");
        $stmt->execute();
        $comprobar1=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //consulta para comprobar si hay valores un hora antes de la introducidad por el cliente
        $stmt2= $pdo->prepare("SELECT r.fecha_reserva, r.id_mesa, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva
        FROM tbl_reserva r
        INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
        INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
        INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
        WHERE tl.id_tipo_lugar = '$id_tipo_lugar' AND r.id_mesa = '$id_mesa' AND r.fecha_reserva = '$dia' AND r.fecha_ini_reserva = '$hora2'");
        $stmt2->execute();
        $comprobar2=$stmt2->fetchAll(PDO::FETCH_ASSOC);
        
        //consulta para comprobar si hay valores un hora después de la introducidad por el cliente
        $stmt3= $pdo->prepare("SELECT r.fecha_reserva, r.id_mesa, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva
        FROM tbl_reserva r
        INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
        INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
        INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
        WHERE tl.id_tipo_lugar = '$id_tipo_lugar' AND r.id_mesa = '$id_mesa' AND r.fecha_reserva = '$dia' AND r.fecha_ini_reserva = '$hora3'");
        $stmt3->execute();
        $comprobar3=$stmt3->fetchAll(PDO::FETCH_ASSOC);
        
        if(!$comprobar1 == 0){
            session_start();
            $_SESSION['error']=1;
            header("location: ../view/form_reservas.php?id={$id_mesa}&id_pag={$id_pag}&error=error");
            ob_end_flush();
        }elseif(!$comprobar2 == 0){
            session_start();
            $_SESSION['error']=1;
            header("location: ../view/form_reservas.php?id={$id_mesa}&id_pag={$id_pag}&error=error");
            ob_end_flush();
        }elseif(!$comprobar3 == 0){
            session_start();
            $_SESSION['error']=1;
            header("location: ../view/form_reservas.php?id={$id_mesa}&id_pag={$id_pag}&error=error");
            ob_end_flush();
        }else{
            $stmt = $pdo->prepare("INSERT INTO tbl_reserva (fecha_reserva, id_mesa, fecha_ini_reserva, fecha_fin_reserva, nom_cliente_reserva) 
            VALUES (?, ?, ?, ?, ?)");
        
            $stmt->bindParam(1, $dia);
            $stmt->bindParam(2, $id_mesa);
            $stmt->bindParam(3, $hora);
            $stmt->bindParam(4, $fechasalida);
            $stmt->bindParam(5, $n_reserva);
            $stmt->execute();
            header("location: ../view/inicio.php?alert=correcto");
            ob_end_flush();
        }
    }
$pdo->commit();
}catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage();
}