<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Listado de Mascotas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #007BFF;
      color: white;
      text-transform: uppercase;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #e9f5ff;
    }

    caption {
      caption-side: top;
      font-size: 1.5em;
      margin-bottom: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <h1>Reporte de Mascotas</h1>

  <table>
    <colgroup>
      <col style="width: 10%;">
      <col style="width: 25%;">
      <col style="width: 15%;">
      <col style="width: 15%;">
      <col style="width: 10%;">
      <col style="width: 25%;">
    </colgroup>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre Mascota</th>
        <th>Tipo</th>
        <th>Color</th>
        <th>Género</th>
        <th>Propietario</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($listaMascotas as $mascota): ?>
        <tr>
          <td><?php echo $mascota->__GET('idmascota'); ?></td>
          <td><?php echo $mascota->__GET('nombre'); ?></td>
          <td><?php echo $mascota->__GET('tipo'); ?></td>
          <td><?php echo $mascota->__GET('color'); ?></td>
          <td><?php echo $mascota->__GET('genero'); ?></td>
          <td><?php echo $mascota->__GET('idpropietario'); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>
</html>
