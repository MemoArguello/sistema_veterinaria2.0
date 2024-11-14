<?php require "../menu/menu.php" ?>

<?php
include '../db/db.php';
$mascota = $_GET["id"];

$consulta = $conexion->query("SELECT * FROM mascota WHERE id_mascota=".$mascota);
$consulta->execute();

$mascota = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Editar Mascota</span>

            <form action="./editar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre" placeholder="" required value="<?=$mascota->nombre?>">
                </div>
                <label for="nombre" class="label">Especie</label>
                <div class="input-field">
                    <input type="text" name="especie" placeholder="" required value="<?=$mascota->especie?>">
                </div>
                <label for="nombre" class="label">Raza</label>
                <div class="input-field">
                    <input type="text" name="raza" placeholder="" required value="<?=$mascota->raza?>">
                </div>
                <label for="nombre" class="label">Sexo</label>
                <div class="input-field">
                    <select name="sexo" required>
                        <option value="">Seleccione una opcion</option>
                        <option value="Macho">Macho</option>
                        <option value="Hembra">Hembra</option>
                    </select>
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Editar</button>
                    <input type="hidden" name="id_mascota" placeholder="" required value="<?=$mascota->id_mascota?>">
                </div>
            </form>
        </div>
    </div>
</div>