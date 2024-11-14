<?php
include "../db/db.php";

if (empty($_POST["nombre"]) || empty($_POST["id_usuario"]) ) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $nombre = $_POST["nombre"];
    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se registro una vacuna";

    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    $guardar = $conexion->prepare("INSERT INTO vacunas (nombre) VALUES (?)");
    $resultado = $guardar->execute([$nombre]);

  
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./listado.php';</script>";
    }
    
}
