<?php require "../menu/menu.php"?>

<?php 


?>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Registrar Proveedor</span>

                <form action="./guardar.php" method="POST">
                <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                    <label for="nombre" class="label">Nombre</label>
                    <div class="input-field">
                        <input type="text" name="nombre_proveedor" placeholder="" required>
                    </div>
                    <label for="nombre" class="label">RUC</label>
                    <div class="input-field">
                        <input type="text" name="ruc_proveedor" placeholder="" required>
                    </div>

                    <div class="input-field button">
                        <button class="boton" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>