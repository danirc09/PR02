<?php
require_once '../services/config.php';
require_once '../services/connection.php';


?>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<h1>Ver Camareros</h1>
<button type="button" class="btn btn-danger" onclick="location.href='index.php'">Index</button><br><br>

<p><h3>Filtrar por:</h3></p>
    <form method="POST">
        <input type="text" name="name" id="name" placeholder="Nombre...">
        <input type="text" name="apellido" id="apellido" placeholder="Apellido...">
        <!--<input type="submit" name="submit" value="Aplicar">-->
        <button type="button submit" class="btn btn-success" name="submit">Aplicar</button>
    </form>


<?php
    if(!isset($_POST['submit'])){
        $sentencia = mysqli_query($conn,"SELECT * FROM tbl_empleados WHERE tipo_emp='Camarero'");
        ?>
            <table>
    <tr>
        <td>
            <h3>Nombre</h3>
        </td>
        <td>
            <h3>Apellido</h3>
        </td>
        <td>
            <h3>Usuario</h3>
        </td>
    </tr>
        <?php
        foreach($sentencia as $row){ 
        echo "<tr>";
        echo "<td>{$row["nom_emp"]}</td>";
        echo "<td>{$row["apellido_emp"]}</td>";
        echo "<td>{$row["usu_emp"]}</td>";
        echo "</tr>";
        }
        ?>
</table>
<?php
    }else{
        $stn =mysqli_query($conn,"SELECT * FROM tbl_empleados WHERE tipo_emp='Camarero' AND (nom_emp LIKE '{$_POST['name']}' OR apellido_emp LIKE '{$_POST['apellido']}')");
        ?>
        <table>
    <tr>
        <td>
            <h3>Nombre</h3>
        </td>
        <td>
            <h3>Apellido</h3>
        </td>
        <td>
            <h3>Usuario</h3>
        </td>
    </tr>
        <?php
        foreach($stn as $row){ 
        echo "<tr>";
        echo "<td>{$row["nom_emp"]}</td>";
        echo "<td>{$row["apellido_emp"]}</td>";
        echo "<td>{$row["usu_emp"]}</td>";
        echo "</tr>";
        }
        ?>
</table>
        <?php
    }
?>