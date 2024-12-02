<?php
require('../fpdf/fpdf.php');
require "../db/db.php";

// Consulta SQL para obtener los datos de los productos

$consulta = $conexion->query("SELECT usuario.*, roles.descripcion FROM usuario JOIN roles ON roles.id_rol = usuario.id_cargo WHERE usuario.estado=1");
$consulta->execute();

$usuarios = $consulta->fetchAll(PDO::FETCH_OBJ);


// Crear la clase PDF extendiendo FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo (ajusta la ruta a tu imagen)
        $this->Image("../img/mascotas.png", 60, 10, 10);
        
        // Título
        $this->SetFont("Arial", "B", 12);
        $this->Cell(0, 10, utf8_decode("Reporte de todos los Usuarios"), 0, 1, "C");
        
        // Fecha
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, "Fecha: " . date("d/m/Y"), 0, 1, "C");
        
        // Salto de línea
        $this->Ln(5);
        
        // Encabezados de tabla
        $this->SetFont("Arial", "B", 9);
        $this->Cell(10, 5, "ID", 1, 0, "C");
        $this->Cell(60, 5, "Usuario", 1, 0, "C");
        $this->Cell(60, 5, "Cargo", 1, 0, "C");
        $this->Cell(60, 5, "Email", 1, 0, "C");
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
foreach ($usuarios as $usuario) {
    // ID
    $pdf->Cell(10, 5, $usuario->id_usuario, 1, 0, "C");
    $pdf->Cell(60, 5, utf8_decode($usuario->nombre), 1, 0, "C");
    $pdf->Cell(60, 5, utf8_decode($usuario->descripcion), 1, 0, "C");
    $pdf->Cell(60, 5, utf8_decode($usuario->email), 1, 0, "C");

    // Salto de línea al final de cada fila
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output();
?>
