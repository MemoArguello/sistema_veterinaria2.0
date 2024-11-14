<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT * FROM categoria WHERE estado=1");
$consulta->execute();

$categorias = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
<h1>Categorias</h1>
  <a class="botonReporte" href="<?= $Direccion ?>categoria/pdf_categoria.php" target="_blank">
  <i class="fas fa-plus"></i> Reporte PDF
    <a class="botonGuardar" href="<?= $Direccion ?>categoria/nuevo.php">Registrar</a>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th></th>
    </tr>
    <tr>
      <?php foreach ($categorias as $categoria): ?>
    <tr>
      <td><?= $categoria->id_categoria ?></td>
      <td><?= $categoria->nombre_categoria ?></td>
      <td>
      <div class="dropdown">
          <button class="dropbtn">Opciones</button>
          <div class="dropdown-content">
            <a href="editar_frm.php?id=<?=$categoria->id_categoria?>">Editar</a>
            <a href="eliminar.php?id=<?=$categoria->id_categoria?>">Eliminar</a>
          </div>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tr>
  </table>
</div>