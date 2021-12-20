<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>RESERVAS</title>
    <link rel="shortcut icon" href="../img/Aiga_restaurant_inv.svg.png" type="image/x-icon">
    <script src="../js/code.js"></script>
</head>

<body id="portada">
<?php
    include '../services/connection.php';
    include '../services/reserva.php';
        session_start();
            if (!isset($_SESSION['nom_user'])&&!isset($_SESSION['correo'])) {
                header('Location: login.php');
                ob_end_flush();
            }
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
                $stmt= $pdo->prepare("SELECT  tl.id_tipo_lugar, l.img_lugar, l.nom_lugar, m.id_mesa, m.numero_mesa, m.estado_mesa, m.num_sillas_mesa FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
                WHERE tl.tipo_lugar = 'Terraza' AND m.estado_mesa = 1
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();

                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($sentencia as $row){
                    echo "<div class='contenido_reservas'>";
                    echo "<b>".$row['nom_lugar']." <img class='icon_reserva' src='../img/{$row['img_lugar']}'></img></b><br>";
                    echo "Mesa: ".$row['numero_mesa']."<br>";
                    echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                    echo "<a href='./form_reservas.php?id={$row['id_mesa']}&id_pag={$row['id_tipo_lugar']}'>RESERVAR</a>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
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
                $stmt= $pdo->prepare("SELECT  tl.id_tipo_lugar, l.img_lugar, l.nom_lugar, m.id_mesa, m.numero_mesa, m.estado_mesa, m.num_sillas_mesa FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
                WHERE tl.tipo_lugar = 'Comedor' AND m.estado_mesa = 1
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();

                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($sentencia as $row){
                    echo "<div class='contenido_reservas'>";
                    echo "<b>".$row['nom_lugar']." <img class='icon_reserva' src='../img/{$row['img_lugar']}'></img></b><br>";
                    echo "Mesa: ".$row['numero_mesa']."<br>";
                    echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                    echo "<a href='./form_reservas.php?id={$row['id_mesa']}&id_pag={$row['id_tipo_lugar']}'>RESERVAR</a>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
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
                $stmt= $pdo->prepare("SELECT tl.id_tipo_lugar, l.img_lugar, l.nom_lugar, m.id_mesa, m.numero_mesa, m.estado_mesa, m.num_sillas_mesa FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar
                WHERE tl.tipo_lugar = 'Sala Privada' AND m.estado_mesa = 1
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();

                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($sentencia as $row){
                    echo "<div class='contenido_reservas'>";
                    echo "<b>".$row['nom_lugar']." <img class='icon_reserva' src='../img/{$row['img_lugar']}'></img></b><br>";
                    echo "Mesa: ".$row['numero_mesa']."<br>";
                    echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                    echo "<a href='./form_reservas.php?id={$row['id_mesa']}&id_pag={$row['id_tipo_lugar']}'>RESERVAR</a>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
        ?>
    <?php
}
?>
</body>
</html>