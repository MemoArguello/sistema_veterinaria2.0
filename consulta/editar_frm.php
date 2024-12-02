<?php require "../menu/menu.php" ?>

<?php
include '../db/db.php';
$id = $_GET["id"];

$consulta = $conexion->query("SELECT * FROM consultas WHERE id_consultas=". $id);
$consulta->execute();

$consultas = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Registrar Consultas</span>

            <form action="./editar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
            <input type="hidden" name="id_consultas" placeholder="" required value="<?=$consultas->id_consultas?>"> 

                <label for="nombre" class="label">Motivo de consulta</label>
                <div class="input-field">
                    <input type="text" name="descripcion" placeholder="" required value="<?=$consultas->descripcion?>">
                </div>
                <label for="nombre" class="label">Fecha de consulta</label>
                <div class="input-field">
                    <input type="date " name="fecha" placeholder="" required value="<?=$consultas->fecha?>">
                </div>
                <label for="nombre" class="label">Mascota</label>
                <div class="input-field">
                    <select name="id_mascota" required>
                        <option value="">Selecciona una Mascota</option>
                        <?php
                        $sentencia = $conexion->query("SELECT * FROM mascota WHERE estado=1");
                        $mascotas = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($mascotas as $mascota) {
                            $selected = ($mascota->id_mascota == $consultas->id_mascota) ? 'selected' : '';
                            echo "<option value='" . $mascota->id_mascota . "' $selected>" . $mascota->nombre . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <label for="nombre" class="label">Veterinario</label>
                <div class="input-field">
                    <select name="id_veterinaria" required>
                        <option value="">Selecciona un Veterinario</option>
                        <?php
                        $sentencia = $conexion->query("SELECT * FROM veterinario WHERE estado=1");
                        $veterinarias = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($veterinarias as $veterinaria) {
                            $selected = ($veterinaria->id_veterinaria == $consultas->id_veterinaria) ? 'selected' : '';
                            echo "<option value='" . $veterinaria->id_veterinaria . "' $selected>" . $veterinaria->nombre . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <label for="nombre" class="label">Vacuna</label>
                <div class="input-field">
                    <select name="id_vacunas">
                        <option value="">Selecciona una Vacuna</option>
                        <?php
                        $sentencia = $conexion->query("SELECT * FROM vacunas WHERE estado=1");
                        $vacunas = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($vacunas as $vacuna) {
                            echo "<option value='" . $vacuna->id_vacunas . "'>" . $vacuna->nombre . "</option>";
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
</div>