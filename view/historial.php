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
            <b><a style="text-decoration:none" class="btn-logout" href="./inicio.php">INICIO</a></b>
            </ul>
        </div>
    </div>
    <div class="flex">
        <div class="menu">
            <h1>HISTORIAL</h1>
        </div> 
    </div>
    <div class="flex">
        <div class="historial">
            <div class="form_historial">
                <form method='post'>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre de la Terraza...">
                    <input type='number' name='mesa' id='mesa' placeholder="Mesa...">
                    <input type='number' name='sillas' id='sillas' placeholder="Sillas...">
                    <input type='date' name='fecha' id='fecha'>
                    <input type='time' name='hora_entrada' id='hora_entrada'>
                    <input type='time' name='hora_salida' id='hora_salida'>
                    <input class="input_resto" type="submit" name="enviar" value="FILTRAR">
                </form>
            </div>
            <div class="result_form">
                <?php
                    $stmt= $pdo->prepare("SELECT r.fecha_reserva, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva, 
                    m.numero_mesa, l.nom_lugar 
                    FROM tbl_reserva r
                    INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
                    INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                    ORDER BY r.fecha_reserva DESC");
                    $stmt->execute();
                    $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($sentencia as $row){
                        echo "<div class='contenido_historial'>";
                        echo "Nombre reserva: ".$row['nom_cliente_reserva']."<br>";
                        echo "Hora de entrada: ".$row['fecha_ini_reserva']."<br>";
                        echo "Hora de salida: ".$row['fecha_fin_reserva']."<br>";
                        echo "Lugar: ".$row['nom_lugar']."<br>";
                        echo "Mesa: ".$row['numero_mesa']."<br>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
    </div>
</body>

</html>