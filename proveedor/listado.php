<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT * FROM proveedor WHERE estado=1");
$consulta->execute();

$proveedores = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Proveedores</h1>
    <a class="botonReporte" href="<?= $Direccion ?>proveedor/pdf_proveedor.php" target="_blank">
    <i class="fas fa-file"></i> Reporte PDF
    </a>
    <a class="botonGuardar" href="<?= $Direccion ?>proveedor/nuevo.php">
      <i class="fas fa-plus"></i> Registrar
    </a>
    <table>
    <tr>
      <th>Nº</th>
      <th>Nombre</th>
      <th>RUC</th>
      <th></th>
    </tr>
    <tr>
      <?php $i=1; foreach ($proveedores as $proveedor): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td><?= $proveedor->nombre_proveedor ?></td>
      <td><?= $proveedor->ruc_proveedor ?></td>
      <td>
        <div class="dropdown">
          <button class="dropbtn">Opciones</button>
          <div class="dropdown-content">
            <a href="editar_frm.php?id=<?=$proveedor->id_proveedor?>">Editar</a>
            <a href="eliminar.php?id=<?=$proveedor->id_proveedor?>">Eliminar</a>
          </div>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tr>
  </table>
</div>