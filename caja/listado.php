<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT * FROM caja WHERE estado=1");
$consulta->execute();

$cajas = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container_listado">
    <h1>Registro de Cajas</h1>
    <a class="botonReporte" href="<?= $Direccion ?>cliente/pdf_cliente.php" target="_blank">
        <i class="fas fa-file"></i> Reporte PDF
        <a class="botonGuardar" href="<?= $Direccion ?>caja/nuevo.php">
            <i class="fas fa-plus"></i> Abrir Caja
        </a>
        <table>
            <tr>
                <th>N°</th>
                <th>Fecha Apertura</th>
                <th>Fecha Cierre</th>
                <th>Ingresos</th>
                <th>Egresos</th>
                <th>Monto Cierre</th>
                <th>Estado</th>
                <th></th>
            </tr>
            <tr>
                <?php foreach ($cajas as $caja): ?>
            <tr>
                <td data-label=""><?= $caja->id_caja ?></td>
                <td data-label=""><?= $caja->fecha_apertura ?></td>
                <td data-label=""><?= $caja->fecha_cierre ?></td>
                <td data-label=""><?= number_format($caja->ingreso, 0, ',', '.') ?>Gs.</td>
                <td data-label=""><?= number_format($caja->egreso, 0, ',', '.') ?>Gs.</td>
                <td data-label=""><?= number_format($caja->saldo_cierre, 0, ',', '.') ?>Gs.</td>
                <td data-label=""><?= $caja->estado_caja ?></td>
                <td>
                    <div class="dropdown">
                        <button class="dropbtn">Opciones</button>
                        <div class="dropdown-content">
                            <a href="cerrar_caja.php?id=<?= $caja->id_caja ?>">Cerrar Caja</a>
                            <a href="eliminar.php?id=<?= $caja->id_caja ?>">Eliminar</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tr>
        </table>
</div>