<?php
include '../db/db.php';

try {
    $consulta = $conexion->prepare("SELECT * FROM caja WHERE estado_caja = 'Abierto'");
    $consulta->execute();
    $caja = $consulta->fetch(PDO::FETCH_OBJ);

    if (!$caja) {
        echo json_encode(array('error' => ' Debe abrir una caja antes de registrar una factura.'));
        exit;
    }

    $id_cliente = $_POST["id_cliente"];
    
    $stmt = $conexion->prepare("INSERT INTO factura_cabecera (id_cliente) VALUES (:id_cliente)");
    $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt->execute();

    $id_cabecera = $conexion->lastInsertId();

    echo json_encode(array('success' => true, 'id_cabecera' => $id_cabecera));

} catch (PDOException $e) {
    echo json_encode(array('error' => 'Error al ingresar la factura: ' . $e->getMessage()));
}
?>
