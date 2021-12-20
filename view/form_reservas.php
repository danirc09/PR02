<?php
ob_start();
include '../services/connection.php';
include '../services/reserva.php';
if (!isset($_GET['id'])&&!isset($_GET['id_pag'])) {
    header('Location: ./inicio.php');
    ob_end_flush();
}else{
    $id_mesa = $_GET['id'];
    $id_pag = $_GET['id_pag'];
}
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
        <div class="flex">
            <div class="contenido_form_reservas">
                <form action="../processes/gen_reserva.proc.php" method="POST">
                    <h1>RESERVAR</h1>
                    <input type="hidden"name="id_mesa" value="<?php echo $id_mesa;?>">
                    <input type="hidden"name="id_pag" value="<?php echo $id_pag;?>">
                    <div class="tam"><input type="text" name="n_reserva" placeholder="Nombre reserva..." required><br>
                    <input type="date" name="txtDate" id="txtDate" min="<?php echo date("Y-m-d"); ?>" required><br>
                    <select name="hora" id="hora" required>
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
                    </select><br>
                    <input type="submit" name="reservar" value="RESERVAR"></div>
                </form>
                <div id="mensaje"><?php
                    if(isset($_GET["error"])){
                    ?>
                        <script>
                            document.getElementById('mensaje').innerHTML = "<p><b>Esta hora ya está reservada</b></p>";
                            document.getElementById('mensaje').style.color = "red";
                        </script>
                    <?php
                    }
                    ?>
                </div>
                <div id="mensaje2"><?php
                    if(isset($_GET["error2"])){
                    ?>
                        <script>
                            document.getElementById('mensaje2').innerHTML = "<p><b>Esta hora ya ha pasado</b></p>";
                            document.getElementById('mensaje2').style.color = "red";
                        </script>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
</body>

</html>