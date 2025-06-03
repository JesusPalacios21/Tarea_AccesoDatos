<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../entities/Propietario.entidad.php';

/**
 * Esta clase contiene la lógica para interactuar con la BD en la tabla propietarios.
 */
class Propietario
{
    private $pdo = null;

    public function __construct()
    {
        $this->pdo = Database::getConexion();
    }

    // Crear un nuevo propietario
    public function create(PropietarioEntidad $entidad): int
    {
        $sql = "INSERT INTO propietarios (apellidos, nombres, dni, telefono, email, direccion) VALUES (?, ?, ?, ?, ?, ?)";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            $entidad->__GET('apellidos'),
            $entidad->__GET('nombres'),
            $entidad->__GET('dni'),
            $entidad->__GET('telefono'),
            $entidad->__GET('email'),
            $entidad->__GET('direccion')
        ]);
        return $this->pdo->lastInsertId();
    }

    // Obtener todos los propietarios
    public function getAll(): array
    {
        $sql = "
        SELECT 
            PR.*, 
            GROUP_CONCAT(CONCAT('(', MA.idmascota, ') ', MA.nombre) ORDER BY MA.idmascota ASC SEPARATOR ', ') AS mascotas
        FROM propietarios PR
        LEFT JOIN mascotas MA ON PR.idpropietario = MA.idpropietario
        GROUP BY PR.idpropietario
        ORDER BY PR.idpropietario ASC;
    ";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    // Obtener un propietario por ID (si es necesario)
    public function getById($id): array
    {
        $sql = "SELECT * FROM propietarios WHERE idpropietario = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Eliminar propietario
    public function delete($id): int
    {
        $sql = "DELETE FROM propietarios WHERE idpropietario = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
        return $query->rowCount();
    }

    // Actualizar propietario
    public function update(PropietarioEntidad $entidad): int
    {
        $sql = "
        UPDATE propietarios SET 
            apellidos = ?, 
            nombres = ?, 
            dni = ?, 
            telefono = ?, 
            email = ?, 
            direccion = ?
        WHERE idpropietario = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            $entidad->__GET('apellidos'),
            $entidad->__GET('nombres'),
            $entidad->__GET('dni'),
            $entidad->__GET('telefono'),
            $entidad->__GET('email'),
            $entidad->__GET('direccion'),
            $entidad->__GET('idpropietario')
        ]);
        return $query->rowCount();
    }
}
