<?php
require "../menu/menu.php";
require "../db/db.php";



$consulta = $conexion->query("SELECT producto.*, proveedor.nombre_proveedor, categoria.nombre_categoria FROM producto 
                            JOIN proveedor ON proveedor.id_proveedor=producto.id_proveedor 
                            JOIN categoria ON categoria.id_categoria=producto.id_categoria
                            WHERE producto.estado=1");
$consulta->execute();

$productos = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Productos</h1>
    <a class="botonReporte" href="<?= $Direccion ?>productos/pdf_productos.php" target="_blank">
        <i class="fas fa-plus"></i> Reporte PDF
    <a class="botonGuardar" href="<?= $Direccion ?>productos/nuevo.php">
      <i class="fas fa-plus"></i> Registrar
    </a>
    <table>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Stock</th>
        <th>Precio</th>
        <th>Proveedor</th>
        <th>Categoria</th>
        <th></th>
      </tr>
    <tr>
      <?php foreach ($productos as $producto): ?>
    <tr>
      <td><?= $producto->id_producto ?></td>
      <td><?= $producto->nombre_producto ?></td>
      <td><?= $producto->stock ?></td>
      <td><?= $producto->precio ?></td>
      <td><?= $producto->nombre_proveedor ?></td>
      <td><?= $producto->nombre_categoria ?></td>
      <td>
        <div class="dropdown">
          <button class="dropbtn">Opciones</button>
          <div class="dropdown-content">
            <a href="editar_frm.php?id=<?=$producto->id_producto?>">Editar</a>
            <a href="eliminar.php?id=<?=$producto->id_producto?>">Eliminar</a>
          </div>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tr>
  </table>
</div