<?php
include "../db/db.php";

if (empty($_POST["nombre"]) || empty($_POST["especie"]) || empty($_POST["raza"]) || empty($_POST["sexo"]) || empty($_POST["id_cliente"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $nombre = $_POST["nombre"];
    $especie = $_POST["especie"];
    $raza = $_POST["raza"];
    $sexo = $_POST["sexo"];
    $dueño = $_POST["id_cliente"];

    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se registro una mascota";

    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    $guardar = $conexion->prepare("INSERT INTO mascota (nombre, especie, raza, sexo, id_cliente) VALUES (?, ?, ?, ?, ?)");
    $resultado = $guardar->execute([$nombre, $especie, $raza, $sexo, $dueño]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./listado.php';</script>";
    }
    
}
