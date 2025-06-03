<?php

require_once '../config/Database.php';
require_once '../entities/Mascota.entidad.php';

/**
 * Esta clase contiene la logica para interactuar con la BD
 */
class Mascota
{

  private $pdo = null;

  public function __construct()
  {
    $this->pdo = Database::getConexion();
  }

  public function create(MascotaEntidad $entidad): int
  {
    $sql = "INSERT INTO mascotas (idpropietario, tipo, nombre, color, genero) VALUES (?,?,?,?,?)";
    $query = $this->pdo->prepare($sql);
    $query = $query->execute([
      $entidad->__GET('idpropietario'),
      $entidad->__GET('tipo'),
      $entidad->__GET('nombre'),
      $entidad->__GET('color'),
      $entidad->__GET('genero')
    ]);
    return $this->pdo->lastInsertId(); //Obtenemos el ultimo ID insertado
  }

  public function getAll(): array
  {
    $sql = "
    SELECT 
      MA.idmascota,
      MA.nombre,
      MA.tipo,
      MA.color,
      MA.genero,
      CONCAT(PR.apellidos, ' ', PR.nombres) 'propietario'
      FROM mascotas MA
      INNER JOIN propietarios PR ON ma.idpropietario = PR.idpropietario
      ORDER BY MA.nombre;
    ";
    $query = $this->pdo->prepare($sql);
    $query->execute();
    //FETCH_CLASS devuelve un arreglo de objetos
    //FETCH_ASSOC devuelve un arreglo asociativo
    //FETCH_OBJ devuelve un arreglo de objetos stdClass
    //FETCH_BOTH devuelve un arreglo asociativo y numerico
    //FETCH_COLUMN devuelve un arreglo de una sola columna
    //FETCH_FUNC devuelve un arreglo de objetos con una funcion de callback
    //FETCH_KEY_PAIR devuelve un arreglo asociativo con la primera columna como clave y la segunda como valor
    //FETCH_UNIQUE devuelve un arreglo asociativo con la primera columna como clave y el resto como valor
    //FETCH_GROUP devuelve un arreglo asociativo agrupado por la primera columna
    return $query->fetchAll(PDO::FETCH_ASSOC); 
  }

  public function getByid(): array
  {
    return [];
  }

  public function delete(): int
  {
    return 0;
  }

  /**
   * Actualiza los datos de una mascota
   * @param mixed Arreglo que contiene los campor requeridos
   * @return int  Numero de filas afectadas por la actualización
   */
  public function update($params = []): int
  {
    $sql = "
    UPDATE mascotas SET 
      idpropietario = ?, 
      tipo = ?, 
      nombre = ?, 
      color = ?, 
      genero = ? 
    WHERE 
      idmascota = ?
    ";
    $query = $this->pdo->prepare($sql);
    $query->execute([
      $params['idpropietario'],
      $params['tipo'],
      $params['nombre'],
      $params['color'],
      $params['genero'],
      $params['idmascota']
    ]);
    return $query->rowCount();
  }
}

