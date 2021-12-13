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
                <div class="div_contenido">
                    <a href="./reservas.php?id=1"><img class="img_terraza" src="../img/terraza.png"></a><h2>Terrazas</h2>
                </div>
                <div class="div_contenido">
                    <a href="./reservas.php?id=2"><img class="img_comedor" src="../img/comedor.png" href=""></a><h2>Comedores</h2>
                </div>
                <div class="div_contenido">
                    <a href="./reservas.php?id=3"><img class="img_sala" src="../img/vip.png" href=""></a><h2>Salas VIP</h2>
                </div>
        </div>
    </div>
    <footer>
    <img class="logo_footer" id="myBtn" onclick="return btn_incidencias();">
            <!-- Boton -->
        <div id="myModal" class="modal">
            <!-- Contenido del Boton -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="content_incidencias"></div>
            </div>
        </div>
        <img class="logo_footer2" id="myBtn2" onclick="return btn_log();">
            <!-- Boton -->
        <div id="myModal2" class="modal">
            <!-- Contenido del Boton -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="content_log">
                </div>
            </div>
        </div>
    </footer>
</body>

</html>