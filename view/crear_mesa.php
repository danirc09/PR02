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
            <form action="../processes/crear_mesa.proc.php" method="post">
                <center><input type="number" name="numero" id="numero" placeholder="numero de mesa..." required></center>
                <center><select name="perfil" id="perfil" required>
                            <option value="%">---</option>
                            <?php
                                $stmt = $pdo->prepare("SELECT * FROM tbl_lugar");
                                $stmt->execute();
                                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($sentencia as $row){
                                        ?>
                                        <option value="<?php echo $row['id_lugar']?>"><?php echo $row['nom_lugar']?></option>
                                        <?php
                                    }
                                ?>
                        </select></center>
                        <input type="hidden" name="estado" id="estado" value="1">
                <center><input type="number" name="sillas" id="sillas" placeholder="sillas..." required></center>
                <center><input type="submit" name="enviar" value="CREAR" class="btn btn-success"></center>
            </form>
            <div id="mensaje"><?php
                    if(isset($_GET["error"])){
                    ?>
                        <script>
                            document.getElementById('mensaje').innerHTML = "<p><b>Esta mesa ya existe</b></p>";
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