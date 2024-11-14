<?php require "../menu/menu.php"?>


    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Registrar Veterinarios</span>

                <form action="./guardar.php" method="POST">
                    <label for="nombre" class="label">Nombre</label>
                    <div class="input-field">
                        <input type="text" name="nombre" placeholder="" required>
                    </div>
                    <label for="nombre" class="label">Telefono</label>
                    <div class="input-field">
                        <input type="text" name="telefono" placeholder="" required>
                    </div>
                    <label for="nombre" class="label">Registro Profesional</label>
                    <div class="input-field">
                        <input type="text" name="registro" placeholder="" required>
                    </div>
                    <div class="input-field button">
                        <button class="boton" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>