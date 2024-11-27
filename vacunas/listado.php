<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT * FROM vacunas WHERE estado=1");
$consulta->execute();

$vacuna = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Vacunas</h1>
    <a class="botonReporte" href="<?= $Direccion ?>vacunas/pdf_vacunas.php" target="_blank">
    <i class="fas fa-file"></i> Reporte PDF
    </a>

    <a class="botonGuardar" href="<?= $Direccion ?>vacunas/nuevo.php">
        <i class="fas fa-plus"></i> Registrar
    </a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th></th>
        </tr>
        <tr>
            <?php foreach ($vacuna as $vacuna): ?>
        <tr>
            <td><?= $vacuna->id_vacunas ?></td>
            <td><?= $vacuna->nombre ?></td>
            <td>
                <div class="dropdown">
                    <button class="dropbtn">Opciones</button>
                    <div class="dropdown-content">
                        <a href="editar_frm.php?id=<?=$vacuna->id_vacunas?>">Editar</a>
                        <a href="eliminar.php?id=<?=$vacuna->id_vacunas?>">Eliminar</a>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tr>
    </table>
</div>
