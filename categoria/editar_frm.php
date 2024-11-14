<?php require "../menu/menu.php" ?>

<?php
include '../db/db.php';
$categoria = $_GET["id"];

$consulta = $conexion->query("SELECT * FROM categoria WHERE id_categoria=".$categoria);
$consulta->execute();

$categoria = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Editar Categoria</span>

            <form action="./editar.php" method="POST">
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre_categoria" placeholder="" required value="<?=$categoria->nombre_categoria?>">
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Editar</button>
                    <input type="hidden" name="id_categoria" placeholder="" required value="<?=$categoria->id_categoria?>">
                </div>
            </form>
        </div>
    </div>
</div>