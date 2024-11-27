<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT * FROM cliente WHERE estado=1");
$consulta->execute();

$clientes = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Clientes</h1>
    <a class="botonReporte" href="<?= $Direccion ?>cliente/pdf_cliente.php" target="_blank">
    <i class="fas fa-file"></i> Reporte PDF
    <a class="botonGuardar" href="<?= $Direccion ?>cliente/nuevo.php">
      <i class="fas fa-plus"></i> Registrar
    </a>
    <table>
    <tr>
      <th>Nº</th>
      <th>Nombre</th>
      <th>Cedula/ruc</th>
      <th></th>
    </tr>
    <tr>
      <?php $i=1; foreach ($clientes as $cliente): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td><?= $cliente->nombre ?></td>
      <td><?= $cliente->cedula_ruc ?></td>
      <td>
        <div class="dropdown">
          <button class="dropbtn">Opciones</button>
          <div class="dropdown-content">
            <a href="editar_frm.php?id=<?=$cliente->id_cliente?>">Editar</a>
            <a href="eliminar.php?id=<?=$cliente->id_cliente?>">Eliminar</a>
          </div>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tr>
  </table>
</div>