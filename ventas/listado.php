<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT factura_cabecera.*, cliente.nombre 
FROM factura_cabecera 
JOIN cliente ON cliente.id_cliente = factura_cabecera.id_cliente 
WHERE factura_cabecera.estado = 1 
ORDER BY factura_cabecera.fecha_creacion DESC;
");
$consulta->execute();

$facturaTotal = $consulta->fetchAll(PDO::FETCH_OBJ);
$PaginaActual = basename($_SERVER['PHP_SELF']);

?>
<div class="container-venta2">

    <div class="topnav" id="myTopnav">
        <a href="./nuevo.php" class="<?php echo ($PaginaActual == 'nuevo.php') ? 'active' : ''; ?>">Formulario de Ventas</a>
        <a href="./listado.php" class="<?php echo ($PaginaActual == 'listado.php') ? 'active' : ''; ?>">Listado de Ventas</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="container_listado-venta">
        <h1>Ventas</h1>
        <a class="reporteAuditoria" href="<?= $Direccion ?>vacunas/pdf_vacunas.php" target="_blank">
            <i class="fas fa-plus"></i> Reporte PDF
        </a>
        <table>
            <tr>
                <th>N°</th>
                <th>Factura</th>
                <th>Cliente</th>
                <th>Fecha de Venta</th>
                <th>Factura</th>
            </tr>
            <tr>
                <?php $i = 1;
                foreach ($facturaTotal as $factura): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $factura->id_cabecera ?></td>
                <td><?= $factura->nombre ?></td>
                <td><?= $factura->fecha_creacion ?></td>
                <td>
                    <form action="./RECEIPT/factura.php" method="POST" target="_blank">
                        <input type="hidden" name="id" value="<?= $factura->id_cabecera ?>">
                        <button type="submit" class="submitBotonFactura">
                            <i class='bx bxs-file-doc'></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tr>
        </table>
    </div>
</div>