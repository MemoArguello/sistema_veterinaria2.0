<?php require "../menu/menu.php" ?>

<?php

include '../db/db.php';
$id_compra = $_GET["id"];
$consulta = $conexion->query("SELECT * FROM compras WHERE id_compras =".$id_compra);
$consulta->execute();

$compras = $consulta->fetch(PDO::FETCH_OBJ);


$sentencia = $conexion->query("SELECT * FROM producto");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia = $conexion->query("SELECT * FROM proveedor");
$proveedores = $sentencia->fetchAll(PDO::FETCH_OBJ);


?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Editar Compras</span>
            <form action="./editar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre de Productos</label>
                <div class="input-field">
                    <select name="id_producto" required>
                        <option value="">Productos</option>
                        <?php
                        foreach ($productos as $producto) {
                            $selected = ($producto->id_producto == $producto->id_producto) ? 'selected' : '';
                            echo "<option value='" . $producto->id_producto . "' $selected>" . $producto->nombre_producto . "</option>";
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
                            $selected = ($proveedor->id_proveedor == $producto->id_proveedor) ? 'selected' : '';
                            echo "<option value='" . $proveedor->id_proveedor . "' $selected>" . $proveedor->nombre_proveedor . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <label for="nombre" class="label">Cantidad</label>
                <div class="input-field">
                    <input type="number" name="cantidad" value="<?=$compras->cantidad?>" placeholder="" required>
                </div>
                <label for="nombre" class="label">Precio de Compras</label>
                <div class="input-field">
                    <input type="number" name="precio_compra" value="<?=$compras->precio_compra?>" placeholder="" required>
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Editar</button>
                    <input type="hidden" name="stock" value="<?=$producto->stock?>">
                    <input type="hidden" name="id_compras" value="<?=$compras->id_compras?>">
                </div>
            </form>
        </div>
    </div>
</div>