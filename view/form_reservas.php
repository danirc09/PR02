<?php
include '../services/connection.php';
include '../services/reserva.php';
session_start();
if (!isset($_SESSION['id_mesa'])&&!isset($_SESSION['id_pag'])) {
    $id_pag = $_SESSION['id_pag'];
    header('Location: reservas.php?id='.$id_pag.'');
}else{
    $id_pag = $_SESSION['id_pag'];
    $id_mesa = $_SESSION['id_mesa'];
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
                    <input type="text" name="n_reserva" placeholder="Nombre reserva..."><br>
                    <input type="date" name="dia" placeholder="..."><br>
                    <select name="hora" id="hora">
                        <option value="%">---</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                        <option value="23:00">23:00</option>
                    </select><br>
                    <input type="number" name="n_personas" placeholder="Num de personas..."><br>
                    <input type="submit" name="reservar" value="RESERVAR">
                </form>
            </div>
        </div>
</body>

</html>