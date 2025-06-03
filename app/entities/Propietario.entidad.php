<?php

/**
 * La entidad Propietario contiene los atributos correspondientes a la tabla propietarios.
 */
class PropietarioEntidad
{
    private $idpropietario;
    private $apellidos;
    private $nombres;
    private $dni;
    private $telefono;
    private $email;
    private $direccion;

    // Métodos de acceso
    public function __GET($atributo)
    {
        return $this->$atributo;
    }

    public function __SET($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
}
