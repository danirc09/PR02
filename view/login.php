<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Login</title>
    <link rel="shortcut icon" href="../img/Aiga_restaurant_inv.svg.png" type="image/x-icon">
    <script src="../js/code.js"></script>
</head>

<body id="portada">
    <br>
    <div class="titulo">
        <h1>EXPERIA EXPERIENCE</h1>
    </div>
    <br>
    <div class="row">
        <form action="../processes/login.proc.php" method="post" onsubmit="return validar();">
            <input type="email" name="email" id="email" placeholder="email...">
            <input type="password" name="password" id="password" placeholder="contraseña...">
            <div id="mensaje"><?php
            if(isset($_GET["error"])){
            ?>
                <p id ="errorinicio" class="erroruser">Los datos introducidos son incorrectos<p>
            <?php
            }
            ?></div>
            <input  class="btn third" type="submit" value="INICIAR SESION">
        </form>
    </div>
</body>

</html>