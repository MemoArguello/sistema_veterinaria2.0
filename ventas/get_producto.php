<?php
include '../db/db.php';

if (isset($_GET['id_categoria'])) {
    $id_categoria = $_GET['id_categoria'];

    try {
        $query = $conexion->prepare("SELECT id_producto, nombre_producto FROM producto WHERE id_categoria = :id_categoria");
        $query->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $query->execute();

        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($resultado) {
            echo json_encode($resultado);
        } else {
            echo json_encode([]); 
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Falta el parámetro id_categoria']);
}
?>
