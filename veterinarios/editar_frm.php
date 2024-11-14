<?php require "../menu/menu.php" ?>

<?php
include '../db/db.php';
$veterinario = $_GET["id"];

$consulta = $conexion->query("SELECT * FROM veterinario WHERE id_veterinaria=".$veterinario);
$consulta->execute();

$veterinario = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Editar Veterinario</span>

            <form action="./editar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre" placeholder="" required value="<?=$veterinario->nombre?>">
                </div>
                <label for="nombre" class="label">Telefono</label>
                <div class="input-field">
                    <input type="text" name="telefono" placeholder="" required value="<?=$veterinario->telefono?>">
                </div>
                <label for="nombre" class="label">Registro Profesional</label>
                <div class="input-field">
                    <input type="text" name="registro" placeholder="" required value="<?=$veterinario->registro?>">
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Editar</button>
                    <input type="hidden" name="id_veterinaria" placeholder="" required value="<?=$veterinario->id_veterinaria?>">
                </div>
            </form>
        </div>
    </div>
</div>