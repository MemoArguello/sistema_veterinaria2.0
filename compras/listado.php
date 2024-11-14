<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT compras.*, proveedor.nombre_proveedor, producto.nombre_producto FROM compras 
                            JOIN proveedor ON proveedor.id_proveedor=compras.id_proveedor 
                            JOIN producto ON producto.id_producto=compras.id_producto
                            WHERE compras.estado=1");
$consulta->execute();

$compras = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Compras</h1>
    <a class="botonReporte" href="<?= $Direccion ?>compras/pdf_compras.php" target="_blank">
      <i class="fas fa-plus"></i> Reporte PDF
    <a class="botonGuardar" href="<?= $Direccion ?>compras/nuevo.php">
      <i class="fas fa-plus"></i> Registrar
    </a>
    <table>
    <tr>
      <th>Nº</th>
      <th>Producto</th>
      <th>Proveedor</th>
      <th>Cantidad</th>
      <th>Precio Compra</th>
      <th>Total Gasto</th>
      <th></th>
    </tr>
    <tr>
      <?php foreach ($compras as $compra): ?>
      <td><?= $compra->id_compras ?></td>
      <td><?= $compra->id_producto ?></td>
      <td><?= $compra->id_proveedor ?></td>
      <td><?= $compra->cantidad ?></td>
      <td><?= $compra->precio_compra ?></td>
      <td><?= $compra->total_gasto ?></td>
      <td>
        <div class="dropdown">
          <button class="dropbtn">Opciones</button>
          <div class="dropdown-content">
            <a href="editar_frm.php?id=<?=$compra->id_compras?>">Editar</a>
            <a href="eliminar.php?id=<?=$compra->id_compras?>">Eliminar</a>
          </div>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tr>
  </table>
</div>