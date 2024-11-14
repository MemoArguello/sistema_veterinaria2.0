<?php require "../menu/menu.php"?>
<?php require "../db/db.php"?>

<?php 

$id_proveedores = $_GET['id'];

$consulta = $conexion->query("SELECT * FROM proveedor WHERE id_proveedor=".$id_proveedores);
$consulta->execute();

$proveedor = $consulta->fetch(PDO::FETCH_OBJ);
?>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Registrar Proveedor</span>

                <form action="./editar.php" method="POST">
                <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                    <label for="nombre" class="label">Nombre</label>
                    <div class="input-field">
                        <input type="text" name="nombre_proveedor" placeholder="" required  value="<?=$proveedor->nombre_proveedor?>">
                    </div>
                    <label for="nombre" class="label">RUC</label>
                    <div class="input-field">
                        <input type="text" name="ruc_proveedor" placeholder="" required  value="<?=$proveedor->ruc_proveedor?>">
                    </div>
                    <div class="input-field button">
                        <button class="boton" type="submit">Guardar</button>
                        <input type="hidden" name="id_proveedor" placeholder="" required value="<?=$proveedor->id_proveedor?>">
                    </div>
                </form>
            </div>
        </div>
    </div>