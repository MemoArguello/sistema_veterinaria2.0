<?php 
require "../../fpdf/fpdf.php";
require "../../db/db.php";

$id = $_POST["id"];
$stmt = $conexion->prepare("
    SELECT factura_detalle.*, factura_cabecera.id_cliente, cliente.nombre AS nombre_cliente, cliente.cedula_ruc, 
           producto.nombre_producto, producto.precio 
    FROM factura_detalle 
    JOIN factura_cabecera ON factura_cabecera.id_cabecera = factura_detalle.id_cabecera 
    JOIN cliente ON cliente.id_cliente = factura_cabecera.id_cliente 
    JOIN producto ON producto.id_producto = factura_detalle.id_producto
    WHERE factura_detalle.id_cabecera = :id_cabecera
");
$stmt->bindParam(':id_cabecera', $id, PDO::PARAM_INT);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_OBJ);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);

// Título de la factura
$pdf->Cell(0, 10, "Mi Mascota", 0, 1, 'C');
$pdf->Ln(5);

// Datos de la empresa y cliente en la misma fila
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(95, 6, "Direccion: Ayolas-Misiones", 0, 0); 
$pdf->Cell(95, 6, "Cliente: " . ($productos[0]->nombre_cliente ?? "N/A"), 0, 1); 
$pdf->Cell(95, 6, "Telefono: 0983864167", 0, 0); 
$pdf->Cell(95, 6, "RUC: " . ($productos[0]->cedula_ruc ?? "N/A"), 0, 1); 
$pdf->Cell(95, 6, "Email: mimascota@gmail.com", 0, 0); 
$pdf->Cell(95, 6, "", 0, 1);
$pdf->Ln(5);

// Tabla de productos
$pdf->SetFont('Arial', 'B', 10);
$header = ["Cod.", "Descripcion", "Cant.", "Precio", "Total"];
$w = [20, 95, 20, 25, 25];

// Encabezado de la tabla
foreach ($header as $col) {
    $pdf->Cell($w[array_search($col, $header)], 7, $col, 1, 0, 'C');
}
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$total = 0;

// Datos de los productos
foreach ($productos as $producto) {
    $cantidad = $producto->cantidad;
    $precio = $producto->precio;
    $subtotal = $cantidad * $precio;
    $total += $subtotal;

    $pdf->Cell($w[0], 6, $producto->id_producto, 1);
    $pdf->Cell($w[1], 6, $producto->nombre_producto, 1);
    $pdf->Cell($w[2], 6, $cantidad, 1, 0, 'R');
    $pdf->Cell($w[3], 6, "$" . number_format($precio, 0), 1, 0, 'R');
    $pdf->Cell($w[4], 6, "$" . number_format($subtotal, 0), 1, 0, 'R');
    $pdf->Ln();
}

// Subtotales y totales
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(160, 6, "Total", 1, 0, 'R');
$pdf->Cell(25, 6, "$" . number_format($total, 0), 1, 0, 'R');

// Salida del PDF
$pdf->Output();
