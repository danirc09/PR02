<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Inicio</title>
    <link rel="shortcut icon" href="../img/Aiga_restaurant_inv.svg.png" type="image/x-icon">
    <script src="../js/code.js"></script>
</head>

<body id="portada">
<?php
include '../services/connection.php';
include '../services/reserva.php';
$id = $_GET['id'];

if($id == 1){
    ?>
    <div class="row2" id="section-1">
        <div class="usuario column-1">
        <ul class="padding-lat">
        <b><a class="btn-logout">TERRAZAS</a></b>
        </ul>
        </div>
        <div class="column-2 titulo2">
            <h1>EXPERIA EXPERIENCE</h1>
        </div>
        <div class="logout column-1">
            <ul class="padding-lat">
            <b><a style="text-decoration:none" class="btn-logout" href="./inicio.php">INICIO</a></b>
            </ul>
        </div>
    </div>
    <?php
            echo "<div class='flex'>";
            echo "<div class='reservas'>";
            ?>
            <form method='post'>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de la Terraza...">
                <input type='number' name='mesa' id='mesa' placeholder="Mesa...">
                <input type='number' name='sillas' id='sillas' placeholder="Sillas...">
                <input type='date' name='fecha' id='fecha'>
                <input type='time' name='hora_entrada' id='hora_entrada'>
                <input type='time' name='hora_salida' id='hora_salida'>
                <input type="submit" name="enviar" value="FILTRAR">
            </form>
            <?php
            if(!isset($_POST['enviar'])){
                $stmt= $pdo->prepare("SELECT l.nom_lugar, m.id_mesa, m.numero_mesa, m.estado_mesa, m.num_sillas_mesa FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
                WHERE tl.tipo_lugar = 'Terraza' 
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($sentencia as $row){
                    echo "<div class='contenido_reservas'>";
                    echo "<b>".$row['nom_lugar']."</b><br>";
                    echo "Mesa: ".$row['numero_mesa']."<br>";
                    echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                    if($row['estado_mesa'] == 0){
                        echo "<b style='color: green;'>Libre</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=1&lugar=Terraza'>RESERVAR</a>";
                    }else{
                        echo "<b style='color: red;'>Ocupada</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=1&lugar=Terraza'>QUITAR RESERVA</a>";
                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
            }else{
                $nombre = $_POST['nombre'];
                $sillas = $_POST['sillas'];
                $mesa = $_POST['mesa'];
                $stmt= $pdo->prepare("SELECT r.fecha_ini_reserva, l.nom_lugar, m.id_mesa, m.numero_mesa, m.estado_mesa, m.num_sillas_mesa FROM tbl_reserva r
                INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
                WHERE tl.tipo_lugar = 'Terraza' AND l.nom_lugar LIKE '%$nombre%' AND m.num_sillas_mesa LIKE '%$sillas%' 
                AND m.numero_mesa LIKE '%$mesa%'
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<div class='reservas2'>";
                foreach($sentencia as $row){
                    echo "<div class='contenido_reservas'>";
                    echo $row['nom_lugar']."<br>";
                    echo "Mesa: ".$row['numero_mesa']."<br>";
                    echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                    if($row['estado_mesa'] == 0){
                        echo "<b style='color: green;'>Libre</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=1&lugar=Terraza'>RESERVAR</a>";
                    }else{
                        echo "<b style='color: red;'>Ocupada</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=1&lugar=Terraza'>QUITAR RESERVA</a>";
                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        ?>
    <?php
}elseif($id == 2){
    ?>
    <div class="row2" id="section-1">
        <div class="usuario column-1">
        <ul class="padding-lat">
        <b><a class="btn-logout">TERRAZAS</a></b>
        </ul>
        </div>
        <div class="column-2 titulo2">
            <h1>EXPERIA EXPERIENCE</h1>
        </div>
        <div class="logout column-1">
            <ul class="padding-lat">
            <b><a style="text-decoration:none" class="btn-logout" href="./inicio.php">INICIO</a></b>
            </ul>
        </div>
    </div>
    <?php
            echo "<div class='flex'>";
            echo "<div class='reservas'>";
            ?>
            <form method='post'>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de la Terraza...">
                <input type='number' name='sillas' id='sillas' placeholder="Sillas...">
                <input type='number' name='mesa' id='mesa' placeholder="Mesa...">
                <input type="submit" name="enviar" value="FILTRAR">
            </form>
            <?php
            if(!isset($_POST['enviar'])){
                $stmt= $pdo->prepare("SELECT l.nom_lugar, m.id_mesa, m.numero_mesa, m.estado_mesa, m.num_sillas_mesa FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
                WHERE tl.tipo_lugar = 'Comedor' 
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<div class='reservas2'>";
                foreach($sentencia as $row){
                    echo "<div class='contenido_reservas'>";
                    echo $row['nom_lugar']."<br>";
                    echo "Mesa: ".$row['numero_mesa']."<br>";
                    echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                    if($row['estado_mesa'] == 0){
                        echo "<b style='color: green;'>Libre</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=2&lugar=Comedor'>RESERVAR</a>";
                    }else{
                        echo "<b style='color: red;'>Ocupada</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=2&lugar=Comedor'>QUITAR RESERVA</a>";
                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }else{
                $nombre = $_POST['nombre'];
                $sillas = $_POST['sillas'];
                $mesa = $_POST['mesa'];
                $stmt= $pdo->prepare("SELECT l.nom_lugar, m.id_mesa, m.numero_mesa, m.estado_mesa, m.num_sillas_mesa FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
                WHERE tl.tipo_lugar = 'Comedor' AND l.nom_lugar LIKE '%$nombre%' AND m.num_sillas_mesa LIKE '%$sillas%' AND m.numero_mesa LIKE '%$mesa%'
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<div class='reservas2'>";
                foreach($sentencia as $row){
                    echo "<div class='contenido_reservas'>";
                    echo $row['nom_lugar']."<br>";
                    echo "Mesa: ".$row['numero_mesa']."<br>";
                    echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                    if($row['estado_mesa'] == 0){
                        echo "<b style='color: green;'>Libre</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=2&lugar=Comedor'>RESERVAR</a>";
                    }else{
                        echo "<b style='color: red;'>Ocupada</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=2&lugar=Comedor'>QUITAR RESERVA</a>";
                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        ?>
    <?php
}else{
    ?>
    <div class="row2" id="section-1">
        <div class="usuario column-1">
        <ul class="padding-lat">
        <b><a class="btn-logout">TERRAZAS</a></b>
        </ul>
        </div>
        <div class="column-2 titulo2">
            <h1>EXPERIA EXPERIENCE</h1>
        </div>
        <div class="logout column-1">
            <ul class="padding-lat">
            <b><a style="text-decoration:none" class="btn-logout" href="./inicio.php">INICIO</a></b>
            </ul>
        </div>
    </div>
    <?php
            echo "<div class='flex'>";
            echo "<div class='reservas'>";
            ?>
            <form method='post'>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de la Terraza...">
                <input type='number' name='sillas' id='sillas' placeholder="Sillas...">
                <input type='number' name='mesa' id='mesa' placeholder="Mesa...">
                <input type="submit" name="enviar" value="FILTRAR">
            </form>
            <?php
            if(!isset($_POST['enviar'])){
                $stmt= $pdo->prepare("SELECT l.nom_lugar, m.id_mesa, m.numero_mesa, m.estado_mesa, m.num_sillas_mesa FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
                WHERE tl.tipo_lugar = 'Sala Privada' 
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<div class='reservas2'>";
                foreach($sentencia as $row){
                    echo "<div class='contenido_reservas'>";
                    echo $row['nom_lugar']."<br>";
                    echo "Mesa: ".$row['numero_mesa']."<br>";
                    echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                    if($row['estado_mesa'] == 0){
                        echo "<b style='color: green;'>Libre</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=3&lugar=Sala Privada'>RESERVAR</a>";
                    }else{
                        echo "<b style='color: red;'>Ocupada</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=3&lugar=Sala Privada'>QUITAR RESERVA</a>";
                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }else{
                $nombre = $_POST['nombre'];
                $sillas = $_POST['sillas'];
                $mesa = $_POST['mesa'];
                $stmt= $pdo->prepare("SELECT l.nom_lugar, m.id_mesa, m.numero_mesa, m.estado_mesa, m.num_sillas_mesa FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
                WHERE tl.tipo_lugar = 'Sala Privada' AND l.nom_lugar LIKE '%$nombre%' AND m.num_sillas_mesa LIKE '%$sillas%' AND m.numero_mesa LIKE '%$mesa%'
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<div class='reservas2'>";
                foreach($sentencia as $row){
                    echo "<div class='contenido_reservas'>";
                    echo $row['nom_lugar']."<br>";
                    echo "Mesa: ".$row['numero_mesa']."<br>";
                    echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                    if($row['estado_mesa'] == 0){
                        echo "<b style='color: green;'>Libre</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=3&lugar=Sala Privada'>RESERVAR</a>";
                    }else{
                        echo "<b style='color: red;'>Ocupada</b> <br>";
                        echo "<a href='../processes/reserva.php?id={$row['id_mesa']}&id_pag=3&lugar=Sala Privada'>QUITAR RESERVA</a>";
                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        ?>
    <?php
}
?>
</body>
</html>