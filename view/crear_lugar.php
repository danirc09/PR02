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
    <title>CREAR LUGARES</title>
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
            $correo = $_SESSION['correo'];
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
            <form enctype="multipart/form-data" action="../processes/crear_lugar.proc.php" method="post">
                <center><input type="text" name="nombre" id="nombre" placeholder="nombre..." required></center>
                <center><select name="perfil" id="perfil" required>
                            <option value="%">---</option>
                            <?php
                                $stmt = $pdo->prepare("SELECT * FROM tbl_tipo_lugar");
                                $stmt->execute();
                                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($sentencia as $row){
                                        ?>
                                        <option value="<?php echo $row['id_tipo_lugar']?>"><?php echo $row['tipo_lugar']?></option>
                                        <?php
                                    }
                                ?>
                        </select></center>
                <center><label class="custom-file-input"><input type="file" name="imagen[]" id="imagen" class="custom-file-input" required>Subir una imagen</label></center>
                <center><input type="submit" name="enviar" value="CREAR" class="btn btn-success"></center>
            </form>
            <div id="mensaje"><?php
                    if(isset($_GET["error"])){
                    ?>
                        <script>
                            document.getElementById('mensaje').innerHTML = "<p><b>Este lugar ya existe</b></p>";
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