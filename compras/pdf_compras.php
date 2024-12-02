<?php
require('../fpdf/fpdf.php');
require "../db/db.php";

// Consulta SQL para obtener los datos de los productos

$consulta = $conexion->query("SELECT compras.*, proveedor.nombre_proveedor, producto.nombre_producto FROM compras 
                            JOIN proveedor ON proveedor.id_proveedor=compras.id_proveedor 
                            JOIN producto ON producto.id_producto=compras.id_producto
                            WHERE compras.estado=1");
$consulta->execute();

$compras = $consulta->fetchAll(PDO::FETCH_OBJ);



// Crear la clase PDF extendiendo FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo (ajusta la ruta a tu imagen)
        $this->Image("../img/compra.png", 60, 10, 10);
        
        // Título
        $this->SetFont("Arial", "B", 12);
        $this->Cell(0, 10, utf8_decode("Reporte de todas las compras"), 0, 1, "C");
        
        // Fecha
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, "Fecha: " . date("d/m/Y"), 0, 1, "C");
        
        // Salto de línea
        $this->Ln(5);
        
        // Encabezados de tabla
        $this->SetFont("Arial", "B", 9);
        $this->Cell(20, 5, "ID", 1, 0, "C");
        $this->Cell(65, 5, "Producto", 1, 0, "C");
        $this->Cell(40, 5, "Proveedor", 1, 0, "C");
        $this->Cell(20, 5, "Cantidad", 1, 0, "C");
        $this->Cell(25, 5, "Precio Compra", 1, 0, "C");
        $this->Cell(20, 5, "Total Gasto", 1, 0, "C");
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
foreach ($compras as $compra) {
    // ID
    $pdf->Cell(20, 5, $compra->id_compras, 1, 0, "C");
    $pdf->Cell(65, 5, utf8_decode($compra->nombre_producto), 1, 0, "C");
    $pdf->Cell(40, 5, utf8_decode($compra->nombre_proveedor), 1, 0, "C");
    $pdf->Cell(20, 5, utf8_decode($compra->cantidad), 1, 0, "C");
    $pdf->Cell(25, 5, utf8_decode($compra->precio_compra), 1, 0, "C");
    $pdf->Cell(20, 5, utf8_decode($compra->total_gasto), 1, 0, "C");

    // Salto de línea al final de cada fila
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output();
?>
