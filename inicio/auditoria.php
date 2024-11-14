<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT auditoria.*, usuario.nombre FROM auditoria JOIN usuario ON usuario.id_usuario=auditoria.id_usuario WHERE auditoria.estado=1");
$consulta->execute();

$auditorias = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Auditoria</h1>
    <a class="reporteAuditoria" href="<?= $Direccion ?>vacunas/pdf_vacunas.php" target="_blank">
        <i class="fas fa-plus"></i> Reporte PDF
    </a>
    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Informacion</th>
            <th>Fecha</th>
        </tr>
        <tr>
            <?php foreach ($auditorias as $auditoria): ?>
        <tr>
            <td><?= $auditoria->id_auditoria ?></td>
            <td><?= $auditoria->nombre ?></td>
            <td><?= $auditoria->informacion ?></td>
            <td><?= $auditoria->fecha ?></td>
        </tr>
    <?php endforeach; ?>
    </tr>
    </table>
</div>
