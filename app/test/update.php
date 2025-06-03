<?php
require_once '../models/Mascota.php';

$mascota = new Mascota();

$parametros = [
  "idpropietario" => 2,
  "tipo"          => "Gato",
  "nombre"        => "Meow",
  "color"         => "Gris con Blanco",
  "genero"        => "macho",
  "idmascota"     => 5 
];

$num = $mascota->update($parametros);
var_dump($num); //Muestra el numero de filas afectadas por la actualización