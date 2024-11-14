<?php
include "../db/db.php";

if (empty($_POST["nombre"]) || empty($_POST["cedula_ruc"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $nombre = $_POST["nombre"];
    $cedula_ruc = $_POST["cedula_ruc"];

    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se registro un cliente";

    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    $guardar = $conexion->prepare("INSERT INTO cliente (nombre, cedula_ruc) VALUES (?, ?)");
    $resultado = $guardar->execute([$nombre, $cedula_ruc]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./nuevo.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./nuevo.php';</script>";
    }
    
}
