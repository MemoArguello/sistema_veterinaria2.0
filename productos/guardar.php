<?php
include "../db/db.php";

if (empty($_POST["nombre_producto"]) || empty($_POST["stock"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $nombre = $_POST["nombre_producto"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $id_proveedor = $_POST["id_proveedor"];
    $id_categoria = $_POST["id_categoria"];

    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se registro un producto";

    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    $guardar = $conexion->prepare("INSERT INTO producto (nombre_producto, stock, precio, id_proveedor, id_categoria) VALUES (?, ?, ?, ?, ?)");
    $resultado = $guardar->execute([$nombre, $stock, $precio, $id_proveedor, $id_categoria]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./listado.php';</script>";
    }
    
}
