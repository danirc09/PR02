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
                <?php
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
                    $stmt= $pdo->prepare("SELECT r.fecha_reserva, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva , r.num_personas_reserva, 
                    l.nom_lugar, m.numero_mesa, m.num_sillas_mesa FROM tbl_reserva r
                    INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
                    INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                    INNER JOIN tbl_tipo_lugar tl ON l.fk_id_tipo_lugar = tl.id_tipo_lugar 
                    ORDER BY r.fecha_fin_reserva DESC");
                    $stmt->execute();
                    $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($sentencia as $row){
                        if(!isset($row['fecha_fin_reserva'])){
                            echo "Cliente: ".$row['nom_cliente_reserva']."<br>";
                            
                            
                            echo "Entrada: ".$row['fecha_ini_reserva']."<br>";
                            echo "Salida: Aún no ha salido<br>";
                            echo "Num personas: ".$row['num_personas_reserva']."<br>";
                            echo "Lugar: ".$row['nom_lugar']."<br>";
                            echo "Mesa: ".$row['numero_mesa']."<br>";
                            echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                        }else{
                            echo "Cliente: ".$row['nom_cliente_reserva']."<br>";
                            echo "Día: ".$row['fecha_reserva'][8].$row['fecha_reserva'][9].$row['fecha_reserva'][7].$row['fecha_reserva'][5].$row['fecha_reserva'][6].$row['fecha_reserva'][4].$row['fecha_reserva'][0].$row['fecha_reserva'][1].$row['fecha_reserva'][2].$row['fecha_reserva'][3]."<br>";
                            echo "Entrada: ".$row['fecha_ini_reserva']."<br>";
                            echo "Salida: ".$row['fecha_fin_reserva']."<br>";
                            echo "Num personas: ".$row['num_personas_reserva']."<br>";
                            echo "Lugar: ".$row['nom_lugar']."<br>";
                            echo "Mesa: ".$row['numero_mesa']."<br>";
                            echo "Sillas: ".$row['num_sillas_mesa']."<br>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>