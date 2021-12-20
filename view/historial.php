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
            if (!isset($_SESSION['nom_user'])&&!isset($_SESSION['correo'])) {
            header('Location: login.php');
            ob_end_flush();
            }
        ?>
    <div class="row2" id="section-1">
        <div class="usuario column-1">
        <ul class="padding-lat">
        <b><a class="btn-logout">HISTORIAL</a></b>
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
        <div class="historial">
            <div class="form_historial">
                <form method='post'>
                    <div class="tam2"><input type="text" name="nom_cliente_reserva" id="nom_cliente_reserva" placeholder="Nombre cliente..."></div>
                    <div class="tam2"><input type="date" name="fecha_reserva" id="fecha_reserva" min="<?php echo date("Y-m-d"); ?>"></div>
                    <div class="tam2"><select name="fecha_ini_reserva" id="fecha_ini_reserva" required>
                        <option value="%">---</option>
                        <option value="12:00:00">12:00</option>
                        <option value="13:00:00">13:00</option>
                        <option value="14:00:00">14:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="16:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>
                        <option value="18:00:00">18:00</option>
                        <option value="19:00:00">19:00</option>
                        <option value="20:00:00">20:00</option>
                        <option value="21:00:00">21:00</option>
                        <option value="22:00:00">22:00</option>
                    </select></div>
                    <div class="tam2"><select name="fecha_fin_reserva" id="fecha_fin_reserva" required>
                        <option value="%">---</option>
                        <option value="12:00:00">12:00</option>
                        <option value="13:00:00">13:00</option>
                        <option value="14:00:00">14:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="16:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>
                        <option value="18:00:00">18:00</option>
                        <option value="19:00:00">19:00</option>
                        <option value="20:00:00">20:00</option>
                        <option value="21:00:00">21:00</option>
                        <option value="22:00:00">22:00</option>
                    </select></div>
                    <div class="tam2"><input type='text' name='nom_lugar' id='nom_lugar' placeholder="Lugar..."></div>
                    <div class="tam2"><input type='number' name='numero_mesa' id='numero_mesa' placeholder="Mesa..."></div>
                    <center><input class="input_resto" type="submit" name="enviar" value="FILTRAR"></center>
                </form>
            </div>
            <?php
            if(!isset($_POST['enviar'])){
                ?>
                <div class="result_form">
                <?php
                    $stmt= $pdo->prepare("SELECT r.id_reserva, r.fecha_reserva, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva, 
                    m.numero_mesa, l.nom_lugar 
                    FROM tbl_reserva r
                    INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
                    INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                    ORDER BY r.fecha_reserva DESC");
                    $stmt->execute();
                    $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    $fecha_actual = getdate();
                    $dia_actual = $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'];
                    foreach($sentencia as $row){
                        if($row['fecha_reserva'] > $dia_actual){
                            echo "<div class='contenido_historial'>";
                            echo "<b>Nombre reserva: </b>".$row['nom_cliente_reserva']."<br>";
                            echo "<b>Día reserva: </b>".$row['fecha_reserva']."<br>";
                            echo "<b>Hora de entrada: </b>".$row['fecha_ini_reserva']."<br>";
                            echo "<b>Hora de salida: </b>".$row['fecha_fin_reserva']."<br>";
                            echo "<b>Lugar: </b>".$row['nom_lugar']."<br>";
                            echo "<b>Mesa: </b>".$row['numero_mesa']."<br><br>";
                            echo "<a href='../processes/elim_reserva.proc.php?id={$row['id_reserva']}'>CANCELAR RESERVA</a>";
                            echo "</div>";
                        }else{
                            echo "<div class='contenido_historial'>";
                            echo "<b>Nombre reserva: </b>".$row['nom_cliente_reserva']."<br>";
                            echo "<b>Día reserva: </b>".$row['fecha_reserva']."<br>";
                            echo "<b>Hora de entrada: </b>".$row['fecha_ini_reserva']."<br>";
                            echo "<b>Hora de salida: </b>".$row['fecha_fin_reserva']."<br>";
                            echo "<b>Lugar: </b>".$row['nom_lugar']."<br>";
                            echo "<b>Mesa: </b>".$row['numero_mesa']."<br><br><br>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            }else{
                ?>
                <div class="result_form">
                <?php
                    $f_reserva = $_POST['fecha_reserva'];
                    $f_in_reserva = $_POST['fecha_ini_reserva'];
                    $f_fin_reserva = $_POST['fecha_fin_reserva'];
                    $n_cliente = $_POST['nom_cliente_reserva'];
                    $n_mesa = $_POST['numero_mesa'];
                    $n_lugar = $_POST['nom_lugar'];
                    $stmt= $pdo->prepare("SELECT r.id_reserva, r.fecha_reserva, r.fecha_ini_reserva, r.fecha_fin_reserva, r.nom_cliente_reserva, 
                    m.numero_mesa, l.nom_lugar 
                    FROM tbl_reserva r
                    INNER JOIN tbl_mesa m ON r.id_mesa = m.id_mesa
                    INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                    WHERE r.fecha_reserva LIKE '%$f_reserva%' AND r.fecha_ini_reserva LIKE '%$f_in_reserva%' AND r.fecha_fin_reserva 
                    LIKE '%$f_fin_reserva%' AND r.nom_cliente_reserva LIKE '%$n_cliente%' AND m.numero_mesa LIKE '%$n_mesa%' AND 
                    l.nom_lugar LIKE '%$n_lugar%'
                    ORDER BY r.fecha_reserva DESC");
                    $stmt->execute();
                    $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    $fecha_actual = getdate();
                    $dia_actual = $fecha_actual['year']."-".$fecha_actual['mon']."-".$fecha_actual['mday'];
                    foreach($sentencia as $row){
                        if($row['fecha_reserva'] > $dia_actual){
                            echo "<div class='contenido_historial'>";
                            echo "<b>Nombre reserva: </b>".$row['nom_cliente_reserva']."<br>";
                            echo "<b>Día reserva: </b>".$row['fecha_reserva']."<br>";
                            echo "<b>Hora de entrada: </b>".$row['fecha_ini_reserva']."<br>";
                            echo "<b>Hora de salida: </b>".$row['fecha_fin_reserva']."<br>";
                            echo "<b>Lugar: </b>".$row['nom_lugar']."<br>";
                            echo "<b>Mesa: </b>".$row['numero_mesa']."<br><br>";
                            echo "<a href='../processes/elim_reserva.proc.php?id={$row['id_reserva']}'>CANCELAR RESERVA</a>";
                            echo "</div>";
                        }else{
                            echo "<div class='contenido_historial'>";
                            echo "<b>Nombre reserva: </b>".$row['nom_cliente_reserva']."<br>";
                            echo "<b>Día reserva: </b>".$row['fecha_reserva']."<br>";
                            echo "<b>Hora de entrada: </b>".$row['fecha_ini_reserva']."<br>";
                            echo "<b>Hora de salida: </b>".$row['fecha_fin_reserva']."<br>";
                            echo "<b>Lugar: </b>".$row['nom_lugar']."<br>";
                            echo "<b>Mesa: </b>".$row['numero_mesa']."<br><br><br>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>
            
    </div>
</body>

</html>