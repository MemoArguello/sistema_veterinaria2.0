<?php require "../menu/menu.php" ?>

<?php


?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Registrar Productos</span>

            <form action="./guardar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre_producto" placeholder="" required>
                </div>
                <label for="nombre" class="label">Stock</label>
                <div class="input-field">
                    <input type="text" name="stock" placeholder="" required>
                </div>
                <label for="nombre" class="label">Precio</label>
                <div class="input-field">
                    <input type="number" name="precio" placeholder="" required>
                </div>
                <div class="input-field">
                    <select name="id_categoria" required>
                        <option value="">Categoria</option>
                        <?php
                        include '../db/db.php';
                        $sentencia = $conexion->query("SELECT * FROM categoria");
                        $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($categorias as $categoria) {
                            echo "<option value='" . $categoria->id_categoria . "'>" . $categoria->nombre_categoria . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-field">
                    <select name="id_proveedor" required>
                        <option value="">Proveedor</option>
                        <?php
                        include '../db/db.php';
                        $sentencia = $conexion->query("SELECT * FROM proveedor");
                        $proveedores = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($proveedores as $proveedor) {
                            echo "<option value='" . $proveedor->id_proveedor . "'>" . $proveedor->nombre_proveedor . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>