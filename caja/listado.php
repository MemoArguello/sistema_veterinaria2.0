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
        <i class="fas fa-plus"></i> Reporte PDF
        <a class="botonGuardar" href="<?= $Direccion ?>caja/apertura.php">
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
            </tr>
            <tr>
            <?php foreach($cajas as $caja): ?>
                <tr>
                    <td data-label=""><?=$caja->id_caja?></td>
                    <td data-label=""><?=$caja->apertura_caja?></td>
                    <td data-label=""><?=$caja->fecha_cierre?></td>
                    <td data-label=""><?=$caja->id_cliente?></td>
                    <td data-label=""><?=$caja->nombre_cliente?></td>
                    <td data-label=""><?=$caja->cedula_ruc?></td>
                    <td data-label="">
                        <a class="" href="eliminar_cliente.php?id=<?=$caja->id_cliente?>"><img class="edit" src="../img/delete.png" alt=""></a>
                    </td>
                </tr>
                <?php endforeach; ?>
        </tr>
        </table>
</div>