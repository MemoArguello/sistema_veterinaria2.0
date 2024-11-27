<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT * FROM veterinario WHERE estado=1");
$consulta->execute();

$veterinarios = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Veterinarios</h1>
    <a class="botonReporte" href="<?= $Direccion ?>veterinarios/pdf_veterinarios.php" target="_blank">
    <i class="fas fa-file"></i> Reporte PDF
    <a class="botonGuardar" href="<?= $Direccion ?>veterinarios/nuevo.php">
      <i class="fas fa-plus"></i> Registrar
    </a>
    <table>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Registro</th>
        <th></th>
      </tr>
    <tr>
      <?php $i=1; foreach ($veterinarios as $veterinario): ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $veterinario->nombre ?></td>
      <td><?= $veterinario->telefono ?></td>
      <td><?= $veterinario->registro ?></td>
      <td>
        <div class="dropdown">
          <button class="dropbtn">Opciones</button>
          <div class="dropdown-content">
            <a href="editar_frm.php?id=<?=$veterinario->id_veterinaria?>">Editar</a>
            <a href="eliminar.php?id=<?=$veterinario->id_veterinaria?>">Eliminar</a>
          </div>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tr>
  </table>
</div