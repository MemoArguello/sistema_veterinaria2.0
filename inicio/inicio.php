<?php
require "../menu/menu.php";
require "../db/db.php";

if (!isset($usuario)) {
    header("location:../../index.php");
}

$PaginaActual = basename($_SERVER['PHP_SELF']);


$queries = [
    "SELECT COUNT(*) total1 FROM cliente",
    "SELECT COUNT(*) total2 FROM producto",
    "SELECT COUNT(*) total3 FROM factura_cabecera",
    "SELECT COUNT(*) total4 FROM proveedor",
    /*"SELECT sum(ingreso) total5 FROM caja",
    /*"SELECT sum(egreso) total6 FROM caja"*/
];

$valores = [];
foreach ($queries as $query) {
    $stmt = $conexion->query($query);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $valores[] = array_values($resultado)[0];
}

$totalClientes = $valores[0];
$totalProductos = $valores[1];
$totalVentas = $valores[2];
$totalProveedores = $valores[3];
/*$totalVentasGs = $valores[4];
$totalComprasGs = $valores[5];*/

$query1 = $conexion->query("SELECT COUNT(*) total1 FROM cliente");
$query2 = $conexion->query("SELECT COUNT(*) total2 FROM producto");
$query3 = $conexion->query("SELECT COUNT(*) total3 FROM factura_cabecera");
$query4 = $conexion->query("SELECT COUNT(*) total4 FROM proveedor");
/*$query5 = $conexion->query("SELECT sum(ingreso) total5 FROM caja");
$query6 = $conexion->query("SELECT sum(egreso) total6 FROM caja");
*/
$query7 = $conexion->query("SELECT COUNT(*) total7 FROM auditoria");
$query8 = $conexion->query("SELECT COUNT(*) total8 FROM usuario");

$query1->execute();
$query2->execute();
$query3->execute();
$query4->execute();
/*$query5->execute();
$query6->execute();*/
$query7->execute();
$query8->execute();

$resultado1 = $query1->fetch(PDO::FETCH_ASSOC);
$resultado2 = $query2->fetch(PDO::FETCH_ASSOC);
$resultado3 = $query3->fetch(PDO::FETCH_ASSOC);
$resultado4 = $query4->fetch(PDO::FETCH_ASSOC);
/*$resultado5 = $query5->fetch(PDO::FETCH_ASSOC);
$resultado6 = $query6->fetch(PDO::FETCH_ASSOC);*/
$resultado7 = $query7->fetch(PDO::FETCH_ASSOC);
$resultado8 = $query8->fetch(PDO::FETCH_ASSOC);
?>

<div class="container-principal">
    <div class="topnav" id="myTopnav">
        <a href="./inicio.php" class="<?php echo ($PaginaActual == 'inicio.php') ? 'active' : ''; ?>">Estadísticas</a>
        <a href="./auditoria.php" class="<?php echo ($PaginaActual == 'auditoria.php') ? 'active' : ''; ?>">Auditoría</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>


    <div class="container-cards">
        <div class="card">
            <img src="../img/clientes3.png" alt="">
            <h3><?= $resultado1['total1'] ?></h3>
            <p><?= $resultado1['total1'] == 1 ? 'Cliente Registrado' : 'Clientes Registrados' ?></p>
        </div>
        <div class="card">
            <img src="../img/producto.png" alt="">
            <h3><?= $resultado2['total2'] ?></h3>
            <p><?= $resultado2['total2'] == 1 ? 'Producto Registrado' : 'Productos Registrados' ?></p>
        </div>
        <div class="card">
            <img src="../img/pay.png" alt="">
            <h3><?= $resultado3['total3'] ?></h3>
            <p><?= $resultado3['total3'] == 1 ? 'Venta Registrada' : 'Ventas Registradas' ?></p>
        </div>
        <div class="card">
            <img src="../img/prov.png" alt="">
            <h3><?= $resultado4['total4'] ?></h3>
            <p><?= $resultado4['total4'] == 1 ? 'Proveedor Registrado' : 'Proveedores Registrados' ?></p>
        </div>
        <div class="card">
            <img src="../img/payment_2898468.png" alt="">
            <h3>0</h3>
            <p>Gs en Ventas Realizadas</p>
        </div>
        <div class="card">
            <img src="../img/smartphone_2898445.png" alt="">
            <h3>0</h3>
            <p>Gs en Compras Realizadas</p>
        </div>
        <div class="card">
            <img src="../img/clipboard_2898450.png" alt="">
            <h3><?= $resultado7['total7'] ?></h3>
            <p><?= $resultado7['total7'] == 1 ? 'Actividad Registrada' : 'Actividades Registradas' ?></p>
        </div>
        <div class="card">
            <img src="../img/call-center_2898354.png" alt="">
            <h3><?= $resultado8['total8'] ?></h3>
            <p><?= $resultado8['total8'] == 1 ? 'Usuario Registrado' : 'Usuarios Registrados' ?></p>
        </div>
    </div>
    <div class="container-cards-grafico">
        <div class="container-grafico">
            <ul class="box-info">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Clientes', 'Productos', 'Ventas', 'Proveedores'],
                datasets: [{
                    label: 'Cantidad',
                    data: [
                        <?php echo $totalClientes; ?>,
                        <?php echo $totalProductos; ?>,
                        <?php echo $totalVentas; ?>,
                        <?php echo $totalProveedores; ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </section>