<?php
require('../fpdf/fpdf.php');
require "../db/db.php";

// Consulta SQL para obtener los datos de los productos
$consulta = $conexion->query("
                                SELECT
                                    factura_detalle.*,
                                    factura_cabecera.*,
                                    producto.*,
                                    cliente.nombre
                                FROM
                                    factura_detalle
                                JOIN
                                    producto
                                    ON producto.id_producto = factura_detalle.id_producto
                                JOIN
                                    factura_cabecera
                                    ON factura_cabecera.id_cabecera = factura_detalle.id_cabecera
                                JOIN
                                    cliente
                                    ON cliente.id_cliente = factura_cabecera.id_cliente
                                WHERE 
                                    factura_detalle.estado =1
                                ORDER BY factura_cabecera.id_cabecera ASC
                                
                            ");
$consulta->execute();

$facturaTotal = $consulta->fetchAll(PDO::FETCH_OBJ);


// Crear la clase PDF extendiendo FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo (ajusta la ruta a tu imagen)
        $this->Image("../img/ventas.png", 60, 10, 10);
        
        // Título
        $this->SetFont("Arial", "B", 12);
        $this->Cell(0, 10, utf8_decode("Reporte de todas las ventas"), 0, 1, "C");
        
        // Fecha
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, "Fecha: " . date("d/m/Y"), 0, 1, "C");
        
        // Salto de línea
        $this->Ln(5);
        
        // Encabezados de tabla
        $this->SetFont("Arial", "B", 9);
        $this->Cell(10, 5, "ID", 1, 0, "C");
        $this->Cell(15, 5, "Factura", 1, 0, "C");
        $this->Cell(35, 5, "Cliente", 1, 0, "C");
        $this->Cell(70, 5, "Producto/Servicio", 1, 0, "C");
        $this->Cell(30, 5, "Monto", 1, 0, "C");
        $this->Cell(35, 5, "Fecha de Venta", 1, 0, "C");
        $this->Ln();
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Crear instancia de PDF
$pdf = new PDF("P", "mm", "A4");
$pdf->AliasNbPages();
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Establecer fuente y tamaño para los datos de los productos
$pdf->SetFont("Arial", "", 9);

// Iterar sobre los datos obtenidos y agregar cada fila a la tabla del PDF
foreach ($facturaTotal as $factura) {
    // ID
    $pdf->Cell(10, 5, $factura->id_detalle, 1, 0, "C");
    $pdf->Cell(15, 5, utf8_decode($factura->id_cabecera), 1, 0, "C");
    $pdf->Cell(35, 5, utf8_decode($factura->nombre), 1, 0, "C");
    $pdf->Cell(70, 5, utf8_decode($factura->nombre_producto), 1, 0, "C");
    $pdf->Cell(30, 5, utf8_decode($factura->total_pagar), 1, 0, "C");
    $pdf->Cell(35, 5, utf8_decode($factura->fecha_creacion), 1, 0, "C");

    // Salto de línea al final de cada fila
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output();
?>
