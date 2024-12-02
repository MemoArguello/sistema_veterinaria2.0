<?php require "../menu/menu.php" ?>

<?php
include '../db/db.php';
$mascota = $_GET["id"];

$consulta = $conexion->query("SELECT * FROM mascota WHERE id_mascota=" . $mascota);
$consulta->execute();

$mascota = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Editar Mascota</span>

            <form action="./editar.php" method="POST">
                <input type="hidden" name="id_usuario" placeholder="" required value="<?= $_SESSION['id_usuario'] ?>">
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre" placeholder="" required value="<?= $mascota->nombre ?>">
                </div>
                <label for="nombre" class="label">Especie</label>
                <div class="input-field">
                    <input type="text" name="especie" placeholder="" required value="<?= $mascota->especie ?>">
                </div>
                <label for="nombre" class="label">Raza</label>
                <div class="input-field">
                    <input type="text" name="raza" placeholder="" required value="<?= $mascota->raza ?>">
                </div>
                <label for="nombre" class="label">Sexo</label>
                <div class="input-field">
                    <select name="sexo" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Macho" <?= $mascota->sexo == 'Macho' ? 'selected' : '' ?>>Macho</option>
                        <option value="Hembra" <?= $mascota->sexo == 'Hembra' ? 'selected' : '' ?>>Hembra</option>
                    </select>
                </div>

                <label for="nombre" class="label">Dueño</label>
                <div class="input-field">
                    <select name="id_cliente" required>
                        <option value="">Dueño</option>
                        <?php
                        include '../db/db.php';
                        $sentencia = $conexion->query("SELECT * FROM cliente WHERE estado=1");
                        $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($clientes as $cliente) {
                            $selected = ($cliente->id_cliente == $mascota->id_cliente) ? 'selected' : '';
                            echo "<option value='" . $cliente->id_cliente . "'$selected>" . $cliente->nombre . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-field button">
                    <button class="boton" type="submit">Editar</button>
                    <input type="hidden" name="id_mascota" placeholder="" required value="<?= $mascota->id_mascota ?>">
                </div>
            </form>
        </div>
    </div>
</div>