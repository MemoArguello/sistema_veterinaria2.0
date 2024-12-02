<?php
require "../menu/menu.php";
require "../db/db.php";



$consulta = $conexion->query("SELECT consultas.*, mascota.nombre AS nombre_mascota, veterinario.nombre AS nombre_veterinario, vacunas.nombre AS nombre_vacunas FROM consultas 
                              JOIN mascota ON mascota.id_mascota=consultas.id_mascota
                              JOIN veterinario ON veterinario.id_veterinaria=consultas.id_veterinaria
                              LEFT JOIN vacunas ON vacunas.id_vacunas=consultas.id_vacunas
                              WHERE consultas.estado=1");
$consulta->execute();

$consultas = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Consultas Medicas</h1>
    <a class="botonReporte" href="<?= $Direccion ?>consulta/pdf_consultas.php" target="_blank">
    <i class="fas fa-file"></i> Reporte PDF
    <a class="botonGuardar" href="<?= $Direccion ?>consulta/nuevo.php">
      <i class="fas fa-plus"></i> Registrar
    </a>
    <table>
      <tr>
        <th>ID</th>
        <th>Descripcion</th>
        <th>Fecha</th>
        <th>Mascota</th>
        <th>Veterinario</th>
        <th>Vacunas</th>
        <th></th>
      </tr>
    <tr>
      <?php foreach ($consultas as $consulta): ?>
    <tr>
      <td><?= $consulta->id_consultas ?></td>
      <td><?= $consulta->descripcion ?></td>
      <td><?= $consulta->fecha ?></td>
      <td><?= $consulta->nombre_mascota ?></td>
      <td><?= $consulta->nombre_veterinario ?></td>
      <td><?= $consulta->nombre_vacunas ?? 'No aplicado' ?></td>
      <td>
        <div class="dropdown">
          <button class="dropbtn">Opciones</button>
          <div class="dropdown-content">
            <a href="editar_frm.php?id=<?=$consulta->id_consultas?>">Editar</a>
            <a href="eliminar.php?id=<?=$consulta->id_consultas?>">Eliminar</a>
          </div>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tr>
  </table>
</div