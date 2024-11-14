<?php require "../menu/menu.php" ?>

<?php

include '../db/db.php';
$sentencia = $conexion->query("SELECT * FROM producto");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia = $conexion->query("SELECT * FROM proveedor");
$proveedores = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Registrar Compras</span>
            <form action="./guardar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
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
                    <input type="hidden" name="stock" value="<?=$producto->stock?>">
                </div>
            </form>
        </div>
    </div>
</div>