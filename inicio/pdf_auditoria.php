<?php
require('../fpdf/fpdf.php');
require "../db/db.php";

// Consulta SQL para obtener los datos de Auditoria

$consulta = $conexion->query("SELECT auditoria.*, usuario.nombre FROM auditoria
                              JOIN usuario ON usuario.id_usuario=auditoria.id_usuario
                              WHERE auditoria.estado=1");
$consulta->execute();

$auditoria = $consulta->fetchAll(PDO::FETCH_OBJ);


// Crear la clase PDF extendiendo FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo (ajusta la ruta a tu imagen)
        $this->Image("../img/auditoria.png", 60, 10, 10);
        
        // Título
        $this->SetFont("Arial", "B", 12);
        $this->Cell(0, 10, utf8_decode("Registro de Actividades"), 0, 1, "C");
        
        // Fecha
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, "Fecha: " . date("d/m/Y"), 0, 1, "C");
        
        // Salto de línea
        $this->Ln(5);
        
        // Encabezados de tabla
        $this->SetFont("Arial", "B", 9);
        $this->Cell(20, 5, "ID", 1, 0, "C");
        $this->Cell(50, 5, "Usuario", 1, 0, "C");
        $this->Cell(60, 5, "Informacion", 1, 0, "C");
        $this->Cell(60, 5, "Fecha", 1, 0, "C");
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

// Establecer fuente y tamaño para los datos de la auditoria
$pdf->SetFont("Arial", "", 9);

// Iterar sobre los datos obtenidos y agregar cada fila a la tabla del PDF
foreach ($auditoria as $auditoria) {
    // ID
    $pdf->Cell(20, 5, $auditoria->id_auditoria, 1, 0, "C");
    $pdf->Cell(50, 5, utf8_decode($auditoria->nombre), 1, 0, "C");
    $pdf->Cell(60, 5, utf8_decode($auditoria->informacion), 1, 0, "C");
    $pdf->Cell(60, 5, utf8_decode($auditoria->fecha), 1, 0, "C");

    // Salto de línea al final de cada fila
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output();
?>
