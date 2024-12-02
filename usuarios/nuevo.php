<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT usuario.*, roles.descripcion FROM usuario JOIN roles ON roles.id_rol = usuario.id_cargo WHERE usuario.estado=1");
$consulta->execute();

$auditorias = $consulta->fetchAll(PDO::FETCH_OBJ);
$PaginaActual = basename($_SERVER['PHP_SELF']);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Registrar Usuario</span>

            <form action="./guardar.php" method="POST">
                <input type="hidden" name="id_usuario" placeholder="" required value="<?= $_SESSION['id_usuario'] ?>">

                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre" placeholder="" required>
                </div>

                <label for="nombre" class="label">Email</label>
                <div class="input-field">
                    <input type="email" name="email" placeholder="" required>
                </div>

                <label for="nombre" class="label">Contraseña</label>
                <div class="input-field">
                    <input type="password" name="codigo" placeholder="" required>
                </div>

                <label for="nombre" class="label">Confirmar Contraseña</label>
                <div class="input-field">
                    <input type="password" name="codigo2" placeholder="" required>
                </div>

                <label for="nombre" class="label">Cargo</label>
                <div class="input-field">
                    <select name="id_cargo" required>
                        <option value="">Seleccione una Opcion</option>
                        <?php
                        include '../db/db.php';
                        $sentencia = $conexion->query("SELECT * FROM roles");
                        $roles = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($roles as $rol) {
                            echo "<option value='" . $rol->id_rol . "'>" . $rol->descripcion . "</option>";
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