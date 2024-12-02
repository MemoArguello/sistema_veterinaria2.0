<?php
include "../db/db.php";

if (empty($_POST["nombre_categoria"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $nombre_categoria = $_POST["nombre_categoria"];

    $guardar = $conexion->prepare("INSERT INTO categoria (nombre_categoria) VALUES (?)");
    $resultado = $guardar->execute([$nombre_categoria]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./nuevo.php';</script>";
    }
    
}
