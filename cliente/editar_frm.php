<?php require "../menu/menu.php" ?>

<?php
include '../db/db.php';
$cliente = $_GET["id"];

$consulta = $conexion->query("SELECT * FROM cliente WHERE id_cliente=".$cliente);
$consulta->execute();

$cliente = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Editar Cliente</span>

            <form action="./editar.php" method="POST">
            <input type="hidden" name="id_usuario" placeholder="" required value="<?=$_SESSION['id_usuario']?>"> 
                <label for="nombre" class="label">Nombre</label>
                <div class="input-field">
                    <input type="text" name="nombre" placeholder="" required value="<?=$cliente->nombre?>">
                </div>
                <label for="nombre" class="label">Cedula/ruc</label>
                <div class="input-field">
                    <input type="text" name="cedula_ruc" placeholder="" required value="<?=$cliente->cedula_ruc?>">
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Editar</button>
                    <input type="hidden" name="id_cliente" placeholder="" required value="<?=$cliente->id_cliente?>">
                </div>
            </form>
        </div>
    </div>
</div>