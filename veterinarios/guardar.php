<?php
include "../db/db.php";

if (empty($_POST["nombre"]) || empty($_POST["telefono"]) || empty($_POST["registro"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $registro = $_POST["registro"];

    $guardar = $conexion->prepare("INSERT INTO veterinario (nombre, telefono, registro) VALUES (?,?,?)");
    $resultado = $guardar->execute([$nombre, $telefono, $registro]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./listado.php';</script>";
    }
    
}
