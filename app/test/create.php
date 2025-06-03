<?php
require_once '../entities/Mascota.entidad.php';
require_once '../models/Mascota.php';

//Entidad = Contenedor de datos
$entidad = new MascotaEntidad();
$entidad->__SET('idpropietario', 1);
$entidad->__SET('tipo', 'Gato');
$entidad->__SET('nombre', 'Miau');
$entidad->__SET('color', 'Gris');
$entidad->__SET('genero', 'macho');


//Modelo = Accion/Logica backend
$mascota = new Mascota();
$idgenerado = $mascota->create($entidad);
var_dump($idgenerado);