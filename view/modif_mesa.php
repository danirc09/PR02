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
            $id_mesa = $_GET['id'];
        ?>
    <div class="row2" id="section-1">
        <div class="usuario column-1">
        <ul class="padding-lat">
        <b><a class="btn-logout">ADMINISTRAR LUGARES</a></b>
        </ul>
        </div>
        <div class="column-2 titulo2">
            <h1>EXPERIA EXPERIENCE</h1>
        </div>
        <div class="logout column-1">
            <ul class="padding-lat">
            <b><a style="text-decoration:none" class="btn-logout" href="./zona_admin.php">INICIO</a></b>
            </ul>
        </div>
    </div>
    <div class="flex">
        <div class="menu">
            <h1>ADMINISTRACIÓN</h1>
        </div> 
    </div>
    <div class="flex">
        <div class="contenido_admin_users">
            <?php
                $stmt = $pdo->prepare("SELECT m.*, l.nom_lugar FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                WHERE id_mesa = '{$id_mesa}'");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($sentencia as $row){
                    ?>
                    <form action="../processes/modif_mesa.proc.php" method="post">
                            <?php echo $row['nom_lugar']?><br>
                            <?php echo "Mesa ".$row['numero_mesa']?>
                            <input type="hidden" name="id_mesa" value="<?php echo $id_mesa?>">
                            <input type="hidden" name="id_lugar" value="<?php echo $id_mesa?>">
                    <center><select name="estado" id="estado" required>
                            <option value="%">---</option>
                            <option value="0">No disponible</option>
                            <option value="1">Disponible</option>
                            <option value="2">Mantenimiento</option>
                        </select></center>
                    <center><input type="number" name="sillas" id="sillas" value="<?php echo $row['num_sillas_mesa']?>" required></center>
                    <center><input type="submit" name="enviar" value="ENVIAR" class="btn btn-success"></center>
            </form>
                    <?php
                }
            ?>
            <div id="mensaje"><?php
                if(isset($_GET["error"])){
                ?>
                    <script>
                        document.getElementById('mensaje').innerHTML = "<p><b>No se ha podido modificar el lugar</b></p>";
                        document.getElementById('mensaje').style.color = "red";
                    </script>
                <?php
                }
                ?>
            </div>
        </div>        
    </div>
</body>

</html>