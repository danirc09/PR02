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
    <title>MODIF USERS</title>
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
            $id_usr = $_GET['id'];
        ?>
    <div class="row2" id="section-1">
        <div class="usuario column-1">
        <ul class="padding-lat">
        <b><a class="btn-logout">ADMINISTRAR USUARIOS</a></b>
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
                $stmt = $pdo->prepare("SELECT * FROM tbl_usuario
                WHERE id = '{$id_usr}'");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($sentencia as $row){
                    ?>
                    <form action="../processes/modif_user.proc.php" method="post">
                            <input type="hidden" name="id_usr" value="<?php echo $id_usr?>">
                    <center><input type="text" name="nombre" id="nombre" value="<?php echo $row['nom_usuario']?>" required></center>
                    <center><input type="text" name="apellido" id="apellido" value="<?php echo $row['apellido_usuario']?>" required></center>
                    <center><input type="email" name="email" id="email" value="<?php echo $row['correo_usuario']?>" required></center>
                    <center><input type="submit" name="enviar" value="ENVIAR" class="btn btn-success"></center>
            </form>
                    <?php
                }
            ?>
            <div id="mensaje"><?php
                if(isset($_GET["error"])){
                ?>
                    <script>
                        document.getElementById('mensaje').innerHTML = "<p><b>No se ha podido modificar el usuario</b></p>";
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