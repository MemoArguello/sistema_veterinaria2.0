<?php require "../menu/menu.php"?>

<?php 
$id_usuario = $_SESSION['id_usuario'];

?>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Registrar Vacunas</span>

                <form action="./guardar.php" method="POST">
                <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 

                    <label for="nombre" class="label">Nombre</label>
                    <div class="input-field">
                        <input type="text" name="nombre" placeholder="" required>
                    </div>

                    <div class="input-field button">
                        <button class="boton" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>