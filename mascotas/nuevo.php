<?php require "../menu/menu.php" ?>

<?php

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Registrar Mascotas</span>

            <form action="./guardar.php" method="POST">
            <input type="hidden" name="id_usuario" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre" placeholder="" required>
                </div>
                <label for="nombre" class="label">Especie</label>
                <div class="input-field">
                    <input type="text" name="especie" placeholder="" required>
                </div>
                <label for="nombre" class="label">Raza</label>
                <div class="input-field">
                    <input type="text" name="raza" placeholder="" required>
                </div>
                <label for="nombre" class="label">Sexo</label>
                <div class="input-field">
                    <select name="sexo" required>
                        <option value="">Seleccione una opcion</option>
                        <option value="Macho">Macho</option>
                        <option value="Hembra">Hembra</option>
                    </select>
                </div>
                <div class="input-field">
                    <select name="id_cliente" required>
                        <option value="">Dueño</option>
                        <?php
                        include '../db/db.php';
                        $sentencia = $conexion->query("SELECT * FROM cliente");
                        $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($clientes as $cliente) {
                            echo "<option value='" . $cliente->id_cliente . "'>" . $cliente->nombre . "</option>";
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