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
            <span class="title">Registrar Servicio</span>

            <form action="./editarServicio.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre_producto" placeholder="" required value="<?=$productos->nombre_producto?>">
                </div>
                <label for="nombre" class="label">Precio</label>
                <div class="input-field">
                    <input type="number" name="precio" placeholder="" value="<?=$productos->precio?>" required>
                </div>
                <div class="input-field">
                    <select name="id_categoria" required>
                        <option value="">Categoria</option>
                        <?php
                        $sentencia = $conexion->query("SELECT * FROM categoria WHERE estado=1");
                        $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($categorias as $categoria) {
                                    $selected = ($categoria->id_categoria == $productos->id_categoria) ? 'selected' : '';
                                    echo "<option value='" . $categoria->id_categoria . "' $selected>" . $categoria->nombre_categoria . "</option>";
                                }
                        ?>
                    </select>
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Guardar</button>
                    <input type="readonly" name="id_producto" placeholder="" required value="<?=$productos->id_producto?>">
                </div>
            </form>
        </div>
    </div>
</div>