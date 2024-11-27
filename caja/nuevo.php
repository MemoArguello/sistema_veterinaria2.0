<?php require "../menu/menu.php"?>

    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Abrir Caja</span>

                <form action="./guardar.php" method="POST">
                    <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                    <label for="nombre" class="label">Fecha Apertura</label>
                    <div class="input-field">
                        <input type="date" name="fecha_apertura" placeholder="" required>
                    </div>

                    <div class="input-field button">
                        <button class="boton" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>