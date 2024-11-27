<?php require "../menu/menu.php" ?>

<?php
include '../db/db.php';
?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Registrar Consultas</span>

            <form action="./guardar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Mascota</label>
                <div class="input-field">
                    <select name="id_mascota" required>
                        <option value="">Selecciona una Mascota</option>
                        <?php
                        $sentencia = $conexion->query("SELECT * FROM mascota WHERE estado=1");
                        $mascotas = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($mascotas as $mascota) {
                            echo "<option value='" . $mascota->id_mascota . "'>" . $mascota->nombre . "</option>";
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
                            echo "<option value='" . $veterinaria->id_veterinaria . "'>" . $veterinaria->nombre . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <label for="nombre" class="label">Motivo de consulta</label>
                <div class="input-field">
                    <input type="text" name="descripcion" placeholder="" required>
                </div>
                <label for="nombre" class="label">Fecha de consulta</label>
                <div class="input-field">
                    <input type="date" name="fecha" placeholder="" required>
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>