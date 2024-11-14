<?php
include "../db/db.php";

if (empty($_POST["ruc_proveedor"]) || empty($_POST["nombre_proveedor"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $ruc_proveedor = $_POST["ruc_proveedor"];
    $nombre_proveedor = $_POST["nombre_proveedor"];

    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se registro un proveedor";

    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    $guardar = $conexion->prepare("INSERT INTO proveedor (ruc_proveedor, nombre_proveedor) VALUES (?, ?)");
    $resultado = $guardar->execute([$ruc_proveedor, $nombre_proveedor]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./nuevo.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./nuevo.php';</script>";
    }
    
}
