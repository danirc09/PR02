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
                $stmt = $pdo->prepare("SELECT u.*, p.perfil_usuario FROM tbl_usuario u
                INNER JOIN tbl_perfil p ON u.id_perfil_usuario = p.id
                ORDER BY nom_usuario ASC");
                $stmt->execute();
                $sentencia=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    try{
                        if(!$sentencia == ""){
                            ?>
                            <a href="./crear_user.php" class="">Crear Usuario</a>
                            <div id="mensaje"><?php
                                    if(isset($_GET["error"])){
                                ?>
                                    <script>
                                        document.getElementById('mensaje').innerHTML = "<p><b>No se ha podido eliminar el evento</b></p>";
                                        document.getElementById('mensaje').style.color = "red";
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
                                            <h3>Apellido</h3>
                                        </td>
                                        <td>
                                            <h3>Correo</h3>
                                        </td>
                                        <td>
                                            <h3>Tipo</h3>
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
                                            if($correo == $row["correo_usuario"]){
                                                echo "<tr class='contenido_tbl_users'>";
                                                echo "<td>{$row["nom_usuario"]}</td>";
                                                echo "<td>{$row["apellido_usuario"]}</td>";
                                                echo "<td>{$row["correo_usuario"]}</td>";
                                                echo "<td>{$row["perfil_usuario"]}</td>";
                                                echo "<td><a href='./modif_user.php?id={$row['id']}'>Modificar</a></td>";
                                                echo "<td><a href='#'><del>Eliminar</del></a></td>";
                                                
                                                echo "</tr>";
                                            }else{
                                                echo "<tr class='contenido_tbl_users'>";
                                                echo "<td>{$row["nom_usuario"]}</td>";
                                                echo "<td>{$row["apellido_usuario"]}</td>";
                                                echo "<td>{$row["correo_usuario"]}</td>";
                                                echo "<td>{$row["perfil_usuario"]}</td>";
                                                echo "<td><a href='./modif_user.php?id={$row['id']}'>Modificar</a></td>";
                                                echo "<td><a href='../processes/elim_usr.proc.php?id={$row['id']}'>Eliminar</a></td>";
                                                echo "</tr>";
                                            }
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