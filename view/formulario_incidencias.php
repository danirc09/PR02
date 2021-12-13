<!DOCTYPE html>
<html>
<body>
<?php
    $mesa = $_GET['id_mesa'];
    // echo $mesa;
    if(isset($_POST['Nombre_incidencia'])){
        $incidencia->registrar_incidencia($mesa);
    }
?>
<h2>Formulario incidencia</h2>

<form action="form_incidencia.php?id_mesa=<?php echo $mesa;?>" method="POST">
  <label for="Nombre_incidencia">Nombre incidencia:</label><br>
  <input type="text" id="Nombre_incidencia" name="Nombre_incidencia"><br>
  <label for="descripcion">Descripción:</label><br>
  <input type="msg" id="descripcion" name="descripcion"><br><br>
  <input type="submit" value="Submit">
</form> 
<?php

?>
</body>
</html>
