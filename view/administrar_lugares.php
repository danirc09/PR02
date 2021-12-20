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
            if (!isset($_SESSION['nom_user'])) {
            header('Location: login.php');
            ob_end_flush();
            }
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
        <div class="contenido_admin">
            <div>
            <a href="./crear_lugar.php" class="">Crear Lugar</a>
            <a href="./crear_mesa.php" class="">Crear Mesa</a><br>
            </div>
            <h2>LUGARES</h2>
            <?php
                $stmt = $pdo->prepare("SELECT tl.*, l.* FROM tbl_tipo_lugar tl
                INNER JOIN tbl_lugar l ON tl.id_tipo_lugar = l.fk_id_tipo_lugar
                ORDER BY l.nom_lugar ASC");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    try{
                        if(!$sentencia == ""){
                            ?>
                            <div id="mensaje"><?php
                                    if(isset($_GET["error"])){
                                ?>
                                    <script>
                                        document.getElementById('mensaje').innerHTML = "<p><b>No se ha podido eliminar el lugar</b></p>";
                                        document.getElementById('mensaje').style.color = "red";
                                    </script>
                                <?php
                                }
                                ?>
                            </div>
                            <div id="exito"><?php
                                    if(isset($_GET["exito"])){
                                ?>
                                    <script>
                                        alert('Debes crear mesas asociadas a este lugar para que esté activo por completo.');
                                    </script>
                                <?php
                                }
                                ?>
                            </div>
                                <table cellspacing = '20px' class="contenido_tbl_users">
                                    <tr class="contenido_tbl_users">
                                        <td>
                                            <h3>Nombre</h3>
                                        </td>
                                        <td>
                                            <h3>Tipo Lugar</h3>
                                        </td>
                                        <td>
                                            <h3>Modificar</h3>
                                        </td>
                                        <td>
                                            <h3>Eliminar</h3>
                                        </td>
                                    </tr>
                                        <?php
                                        foreach($sentencia as $row){ 
                                                echo "<tr class='contenido_tbl_users'>";
                                                echo "<td>{$row["nom_lugar"]}</td>";
                                                echo "<td>{$row["tipo_lugar"]}</td>";
                                                echo "<td><a href='./modif_lugares.php?id={$row['id_lugar']}'>Modificar</a></td>";
                                                echo "<td><a href='../processes/elim_lugar.proc.php?id={$row['id_lugar']}'>Eliminar</a></td>";
                                                echo "</tr>";
                                        }
                                        ?>
                                </table>
                            <?php
                        }else{
                            echo "No hay datos";
                        }
                    }catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                ?>
                <h2>MESAS</h2>
                <?php
                $stmt = $pdo->prepare("SELECT m.*, l.* FROM tbl_mesa m
                INNER JOIN tbl_lugar l ON m.id_lugar = l.id_lugar
                ORDER BY m.numero_mesa AND l.nom_lugar ASC");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    try{
                        if(!$sentencia == ""){
                            ?>
                            <div id="mensaje"><?php
                                    if(isset($_GET["error2"])){
                                ?>
                                    <script>
                                        document.getElementById('mensaje').innerHTML = "<p><b>No se ha podido eliminar la mesa</b></p>";
                                        document.getElementById('mensaje').style.color = "red";
                                    </script>
                                <?php
                                }
                                ?>
                            </div>
                                <table cellspacing = '20px' class="contenido_tbl_users">
                                    <tr class="contenido_tbl_users">
                                        <td>
                                            <h3>Mesa</h3>
                                        </td>
                                        <td>
                                            <h3>Lugar</h3>
                                        </td>
                                        <td>
                                            <h3>Estado</h3>
                                        </td>
                                        <td>
                                            <h3>Sillas</h3>
                                        </td>
                                        <td>
                                            <h3>Modificar</h3>
                                        </td>
                                        <td>
                                            <h3>Eliminar</h3>
                                        </td>
                                    </tr>
                                        <?php
                                        foreach($sentencia as $row){ 
                                                echo "<tr class='contenido_tbl_users'>";
                                                echo "<td>{$row["numero_mesa"]}</td>";
                                                echo "<td>{$row["nom_lugar"]}</td>";
                                                if($row["estado_mesa"] == 0){
                                                    echo "<td>No isponible</td>";
                                                }elseif($row["estado_mesa"] == 1){
                                                    echo "<td>Disponible</td>";
                                                }else{
                                                    echo "<td>Mantenimiento</td>";
                                                }
                                                echo "<td>{$row["num_sillas_mesa"]}</td>";
                                                echo "<td><a href='./modif_mesa.php?id={$row['id_mesa']}'>Modificar</a></td>";
                                                echo "<td><a href='../processes/elim_mesa.proc.php?id={$row['id_mesa']}'>Eliminar</a></td>";
                                                echo "</tr>";
                                        }
                                        ?>
                                </table>
                            <?php
                        }else{
                            echo "No hay datos";
                        }
                    }catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                ?>
            </div>

        </div>        
    </div>
</body>

</html>