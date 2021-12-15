<?php
include '../services/connection.php';
include '../services/reserva.php';

$id_mesa = $_POST['id_mesa'];
$id_pag = $_POST['id_pag'];
$n_reserva = $_POST['n_reserva'];
$dia = $_POST['txtDate'];
$hora = $_POST['hora'];
$n_personas = $_POST['n_personas'];

$fecha_actual = getdate();
$dia_actual = $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'];
$hora_actual = $fecha_actual['hours'].":".$fecha_actual['minutes'];

if($dia == $dia_actual && $hora<$hora_actual){
    session_start();
    $_SESSION['error']=1;
    header("location: ../view/form_reservas.php?error2=error_hora");
}else{
    $fechaentrada	= strtotime ( "2 hours" , strtotime ( $hora ) ) ;
    $fechasalida 	= date ( 'H:i:s' , $fechaentrada );
    
    $fechaentrada2	= strtotime ( "-1 hour" , strtotime ( $hora ) ) ;
    $hora2 	= date ( 'H:i:s' , $fechaentrada2 );
    
    $fechaentrada3	= strtotime ( "+1 hour" , strtotime ( $hora ) ) ;
    $hora3 	= date ( 'H:i:s' , $fechaentrada3 );
    
    $stmt= $pdo->prepare("SELECT r.fecha_reserva, r.id_mesa, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva , r.num_personas_reserva 
    FROM tbl_reserva r
    INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
    INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
    INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
    WHERE tl.tipo_lugar = 'Terraza' AND r.id_mesa = '$id_mesa' AND r.fecha_reserva = '$dia' AND r.fecha_ini_reserva = '$hora'");
    $stmt->execute();
    $comprobar1=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt2= $pdo->prepare("SELECT r.fecha_reserva, r.id_mesa, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva , r.num_personas_reserva 
    FROM tbl_reserva r
    INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
    INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
    INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
    WHERE tl.tipo_lugar = 'Terraza' AND r.id_mesa = '$id_mesa' AND r.fecha_reserva = '$dia' AND r.fecha_ini_reserva = '$hora2'");
    $stmt2->execute();
    $comprobar2=$stmt2->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt3= $pdo->prepare("SELECT r.fecha_reserva, r.id_mesa, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva , r.num_personas_reserva 
    FROM tbl_reserva r
    INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
    INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
    INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
    WHERE tl.tipo_lugar = 'Terraza' AND r.id_mesa = '$id_mesa' AND r.fecha_reserva = '$dia' AND r.fecha_ini_reserva = '$hora3'");
    $stmt3->execute();
    $comprobar3=$stmt3->fetchAll(PDO::FETCH_ASSOC);
    
    if(!$comprobar1 == 0){
        session_start();
        $_SESSION['error']=1;
        header("location: ../view/form_reservas.php?error=errorlogin");
    }elseif(!$comprobar2 == 0){
        session_start();
        $_SESSION['error']=1;
        header("location: ../view/form_reservas.php?error=errorlogin");
    }elseif(!$comprobar3 == 0){
        session_start();
        $_SESSION['error']=1;
        header("location: ../view/form_reservas.php?error=errorlogin");
    }else{
        $stmt = $pdo->prepare("INSERT INTO tbl_reserva (fecha_reserva, id_mesa, fecha_ini_reserva, fecha_fin_reserva, nom_cliente_reserva, 
        num_personas_reserva) VALUES (?, ?, ?, ?, ?, ?)");
    
        $stmt->bindParam(1, $dia);
        $stmt->bindParam(2, $id_mesa);
        $stmt->bindParam(3, $hora);
        $stmt->bindParam(4, $fechasalida);
        $stmt->bindParam(5, $n_reserva);
        $stmt->bindParam(6, $n_personas);
        $stmt->execute();
    
        header("location: ../view/reservas.php?id=$id_pag");
    }   
}