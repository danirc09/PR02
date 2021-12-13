<?php 
class Reserva{
  public $id_reserva;
  public $fecha_ini_reserva;
  public $fecha_fin_reserva;
  public $id_mesa;
  public $nom_cliente_reserva;
  public $num_personas_reserva;


  public function __construct($id_reserva,$fecha_ini_reserva,$fecha_fin_reserva,$id_mesa,$nom_cliente_reserva,$num_personas_reserva){
    $this->id_reserva=$id_reserva;
    $this->fecha_ini_reserva=$fecha_ini_reserva;
    $this->fecha_fin_reserva=$fecha_fin_reserva;
    $this->id_mesa=$id_mesa;
    $this->nom_cliente_reserva=$nom_cliente_reserva;
    $this->num_personas_reserva=$num_personas_reserva;
 }

}