<?php require "../menu/menu.php"?>

<?php 
include "../db/db.php";

$id_caja = $_GET["id"];
$consulta = $conexion->query("SELECT * FROM caja WHERE id_caja =".$id_caja);
$consulta->execute();

$caja = $consulta->fetch(PDO::FETCH_OBJ);

?>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Cerrar Caja</span>

                <form action="./cerrar.php" method="POST">
                    <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                    <label for="nombre" class="label">Fecha Cierre</label>
                    <div class="input-field">
                        <input type="date" name="fecha_cierre" placeholder="" required>
                    </div>

                    <div class="input-field button">
                        <button class="boton" type="submit">Guardar</button>
                        <input type="hidden" name="id_caja" value="<?=$caja->id_caja?>" required>
                        <input type="hidden" name="ingreso" value="<?=$caja->ingreso?>">
                        <input type="hidden" name="egreso" value="<?=$caja->egreso?>">
                    </div>
                </form>
            </div>
        </div>
    </div>