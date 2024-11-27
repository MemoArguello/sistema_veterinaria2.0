<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT mascota.*, cliente.nombre FROM mascota
                              JOIN cliente ON cliente.id_cliente=mascota.id_cliente
                              WHERE mascota.estado=1");
$consulta->execute();

$mascotas = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Mascotas</h1>
    <a class="botonReporte" href="<?= $Direccion ?>mascotas/pdf_mascotas.php" target="_blank">
    <i class="fas fa-file"></i> Reporte PDF
    <a class="botonGuardar" href="<?= $Direccion ?>mascotas/nuevo.php">
      <i class="fas fa-plus"></i> Registrar
    </a>
    <table>
    <tr>
      <th>Nº</th>
      <th>Nombre</th>
      <th>Especie</th>
      <th>Raza</th>
      <th>Sexo</th>
      <th>Dueño</th>
      <th></th>
    </tr>
    <tr>
      <?php foreach ($mascotas as $mascota): ?>
    <tr>
      <td><?= $mascota->id_mascota ?></td>
      <td><?= $mascota->nombre ?></td>
      <td><?= $mascota->especie ?></td>
      <td><?= $mascota->raza ?></td>
      <td><?= $mascota->sexo ?></td>
      <td><?= $mascota->id_cliente ?></td>
      <td>
        <div class="dropdown">
          <button class="dropbtn">Opciones</button>
          <div class="dropdown-content">
            <a href="editar_frm.php?id=<?=$mascota->id_mascota?>">Editar</a>
            <a href="eliminar.php?id=<?=$mascota->id_mascota?>">Eliminar</a>
          </div>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tr>
  </table>
</div>