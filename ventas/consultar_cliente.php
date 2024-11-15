<?php
include '../db/db.php';

header('Content-Type: application/json');

try {
    if (!isset($_POST["ciCliente"]) || empty(trim($_POST["ciCliente"]))) {
        echo json_encode(array('error' => 'Cédula no proporcionada o vacía'));
        exit;
    }

    $cedula = trim($_POST["ciCliente"]);
    $estado = 1;

    // Preparar y ejecutar consulta
    $stmt = $conexion->prepare("SELECT * FROM cliente WHERE cedula_ruc = :cedula_ruc AND estado = :estado");
    $stmt->bindParam(':cedula_ruc', $cedula, PDO::PARAM_STR);
    $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
    $stmt->execute();

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        $respuesta = array(
            'nombre' => $cliente['nombre'],
            'id_cliente' => $cliente['id_cliente']
        );
        echo json_encode($respuesta);
    } else {
        echo json_encode(array('error' => 'Cliente no encontrado'));
    }
} catch (PDOException $e) {
    echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
}
?>
