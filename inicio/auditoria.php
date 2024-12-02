<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT auditoria.*, usuario.nombre FROM auditoria JOIN usuario ON usuario.id_usuario=auditoria.id_usuario WHERE auditoria.estado=1");
$consulta->execute();

$auditorias = $consulta->fetchAll(PDO::FETCH_OBJ);
$PaginaActual = basename($_SERVER['PHP_SELF']);

?>
<div class="container-principal">

    <div class="topnav" id="myTopnav">
        <a href="./inicio.php" class="<?php echo ($PaginaActual == 'inicio.php') ? 'active' : ''; ?>">Estadísticas</a>
        <a href="./auditoria.php" class="<?php echo ($PaginaActual == 'auditoria.php') ? 'active' : ''; ?>">Auditoría</a>
        <a href="../usuarios/listado.php" class="<?php echo ($PaginaActual == 'listado.php') ? 'active' : ''; ?>">Usuarios</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="container_listado-venta">
        <h1>Auditoria</h1>
        <a class="reporteAuditoria" href="<?= $Direccion ?>inicio/pdf_auditoria.php" target="_blank">
            <i class="fas fa-file"></i> Reporte PDF
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
</div>