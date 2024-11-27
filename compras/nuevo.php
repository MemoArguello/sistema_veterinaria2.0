<?php require "../menu/menu.php" ?>

<?php

include '../db/db.php';
$sentencia = $conexion->query("SELECT * FROM producto WHERE estado = 1 AND id_proveedor IS NOT NULL");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia = $conexion->query("SELECT * FROM proveedor WHERE estado=1");
$proveedores = $sentencia->fetchAll(PDO::FETCH_OBJ);

$consulta = $conexion->query("SELECT * FROM caja WHERE estado_caja = 'Abierto'");
$consulta->execute();

$caja = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Registrar Compras</span>
            <form action="./guardar.php" method="POST">
                <input type="hidden" name="id_usuario" placeholder="" required value="<?= $_SESSION['id_usuario'] ?>">
                <label for="nombre" class="label">Nombre de Productos</label>
                <div class="input-field">
                    <select name="id_producto" required>
                        <option value="">Productos</option>
                        <?php
                        foreach ($productos as $producto) {
                            echo "<option value='" . $producto->id_producto . "'>" . $producto->nombre_producto . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <label for="nombre" class="label">Nombre de Proveedores</label>
                <div class="input-field">
                    <select name="id_proveedor" required>
                        <option value="">Proveedor</option>
                        <?php
                        foreach ($proveedores as $proveedor) {
                            echo "<option value='" . $proveedor->id_proveedor . "'>" . $proveedor->nombre_proveedor . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <label for="nombre" class="label">Cantidad</label>
                <div class="input-field">
                    <input type="number" name="cantidad" placeholder="" required>
                </div>
                <label for="nombre" class="label">Precio de Compras</label>
                <div class="input-field">
                    <input type="number" name="precio_compra" placeholder="" required>
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Guardar</button>
                    <input type="hidden" name="stock" value="<?= $producto->stock ?>">
                    <?php if ($caja): ?>
                        <input type="hidden" name="egreso" value="<?= $caja->egreso ?>">
                        <?php else: ?>
                        <input type="hidden" id="egreso" name="egreso" value="0">
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>