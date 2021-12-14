<?php
$hora = $_POST['hora'];
echo $hora;
$fechaAuxiliar	= strtotime ( "2 hours" , strtotime ( $hora ) ) ;
$fechaSalida 	= date ( 'H:i:s' , $fechaAuxiliar );
echo "<br>".$fechaSalida;