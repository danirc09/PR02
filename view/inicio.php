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
    <title>Inicio</title>
    <link rel="shortcut icon" href="../img/Aiga_restaurant_inv.svg.png" type="image/x-icon">
    <script src="../js/code.js"></script>
</head>

<body id="portada">
        <?php
            include '../services/connection.php';
            include '../services/reserva.php';
            session_start();
            if (!isset($_SESSION['nom_user'])) {
            header('Location: login.php');
            ob_end_flush();
            }
        ?>
    <div class="row2" id="section-1">
        <div class="usuario column-1">
        <ul class="padding-lat">
        <b><a class="btn-logout">Bienvenido, <?php echo $_SESSION['nom_user'];?></a></b>
        </ul>
        </div>
        <div class="column-2 titulo2">
            <h1>EXPERIA EXPERIENCE</h1>
        </div>
        <div class="logout column-1">
            <ul class="padding-lat">
            <b><a style="text-decoration:none" class="btn-logout" href="../processes/logout.proc.php">Logout</a></b>
            </ul>
        </div>
    </div>
    <div class="flex">
        <div class="menu">
            <h1>LUGARES</h1>
        </div> 
    </div>
    <div class="flex">
            <div class="contenido">
                <?php    
                 $stmt= $pdo->prepare("SELECT * FROM tbl_tipo_lugar");
                 $stmt->execute();
                 $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($sentencia as $row){
                    echo "<div class='div_contenido'>";
                    echo "<a href='./reservas.php?id={$row['id_tipo_lugar']}'><img class='img_inicio' src='../img/{$row['img_tipo_lugar']}'></a><h2>{$row['tipo_lugar']}</h2>";
                    echo "</div>";
                }
                ?>
            </div>
    </div>
    <footer>
        <img class="logo_footer" id="myBtn" onclick="return btn_incidencias();">
        <a href="./historial.php"><img class="logo_footer2" id="myBtn2" onclick="return btn_log();"></a>
    </footer>
    <div>
        <?php
        if(isset($_GET["alert"])){
        ?>
        <script>alert('Reserva completada con éxito');</script>
        <?php
        }
        ?>
    </div>
</body>

</html>