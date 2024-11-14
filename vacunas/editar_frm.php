<?php require "../menu/menu.php" ?>

<?php
include '../db/db.php';
$vacuna = $_GET["id"];

$consulta = $conexion->query("SELECT * FROM vacunas WHERE id_vacunas=".$vacuna);
$consulta->execute();

$vacuna = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Editar Vacunas</span>

            <form action="./editar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre" placeholder="" required value="<?=$vacuna->nombre?>">
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Editar</button>
                    <input type="hidden" name="id_vacunas" placeholder="" required value="<?=$vacuna->id_vacunas?>">
                </div>
            </form>
        </div>
    </div>
</div>