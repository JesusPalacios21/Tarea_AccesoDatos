<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: auto;
    }

    th, td {
      border: 1px solid #999;
      padding: 6px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
      text-transform: uppercase;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>

<h1>Reporte de Propietarios</h1>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Apellidos</th>
      <th>Nombres</th>
      <th>DNI</th>
      <th>Teléfono</th>
      <th>Email</th>
      <th>Dirección</th>
      <th>Mascotas</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listaPropietarios as $p): ?>
      <tr>
        <td><?= $p['idpropietario'] ?></td>
        <td><?= $p['apellidos'] ?></td>
        <td><?= $p['nombres'] ?></td>
        <td><?= $p['dni'] ?></td>
        <td><?= $p['telefono'] ?></td>
        <td><?= $p['email'] ?></td>
        <td><?= $p['direccion'] ?></td>
        <td>
          <?php
          if (isset($p['mascotas'])) {
            echo $p['mascotas'];
          } else {
            echo '-';
          }
          ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</body>
</html>
