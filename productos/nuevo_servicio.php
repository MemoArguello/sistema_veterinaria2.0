<?php require "../menu/menu.php" ?>

<?php


?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Registrar Servicio</span>

            <form action="./guardar_servicio.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre_producto" placeholder="" required>
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
                        $sentencia = $conexion->query("SELECT * FROM categoria WHERE estado=1");
                        $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($categorias as $categoria) {
                            echo "<option value='" . $categoria->id_categoria . "'>" . $categoria->nombre_categoria . "</option>";
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