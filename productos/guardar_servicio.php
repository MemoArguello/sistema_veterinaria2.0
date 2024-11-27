<?php
include "../db/db.php";

if (empty($_POST["nombre_producto"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo_servicio.php';</script>";
} else {
    $nombre = $_POST["nombre_producto"];
    $precio = $_POST["precio"];
    $id_categoria = $_POST["id_categoria"];

    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se registro un Servicio";

    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    $guardar = $conexion->prepare("INSERT INTO producto (nombre_producto, precio, id_categoria) VALUES (?, ?, ?)");
    $resultado = $guardar->execute([$nombre, $precio, $id_categoria]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./nuevo_servicio.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./nuevo_servicio.php';</script>";
    }
    
}
