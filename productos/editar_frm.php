<?php require "../menu/menu.php" ?>

<?php
include '../db/db.php';
$id_producto = $_GET["id"];

$consulta = $conexion->query("SELECT * FROM producto WHERE id_producto=". $id_producto);
$consulta->execute();

$productos = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Editar Productos</span>

            <form action="./editar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre_producto" placeholder="" required value="<?=$productos->nombre_producto?>">
                </div>
                <label for="nombre" class="label">Stock</label>
                <div class="input-field">
                    <input type="text" name="stock" placeholder="" required value="<?=$productos->stock?>">
                </div>
                <div class="input-field">
                    <select name="id_categoria" required>
                        <option value="">Categoria</option>
                        <?php
                        $sentencia = $conexion->query("SELECT * FROM categoria");
                        $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($categorias as $categoria) {
                                    $selected = ($categoria->id_categoria == $productos->id_categoria) ? 'selected' : '';
                                    echo "<option value='" . $categoria->id_categoria . "' $selected>" . $categoria->nombre_categoria . "</option>";
                                }
                        ?>
                    </select>
                </div>
                <div class="input-field">
                    <select name="id_proveedor" required>
                        <option value="">Proveedor</option>
                        <?php
                        $sentencia = $conexion->query("SELECT * FROM proveedor");
                        $proveedores = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($proveedores as $proveedor) {
                            $selected = ($proveedor->id_proveedor == $productos->id_proveedor) ? 'selected' : '';
                            echo "<option value='" . $proveedor->id_proveedor . "' $selected>" . $proveedor->nombre_proveedor . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Editar</button>
                    <input type="hidden" name="id_producto" placeholder="" required value="<?=$productos->id_producto?>">
                </div>
                </div>
            </form>
        </div>
    </div>
</div>