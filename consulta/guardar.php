<?php
include "../db/db.php";

if (empty($_POST["descripcion"]) || empty($_POST["fecha"]) || empty($_POST["id_mascota"]) || empty($_POST["id_veterinaria"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $descripcion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];
    $id_mascota = $_POST["id_mascota"];
    $id_veterinaria = $_POST["id_veterinaria"];

    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se registro una consulta";

    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    $guardar = $conexion->prepare("INSERT INTO consultas (descripcion, fecha, id_mascota, id_veterinaria) VALUES (?, ?, ?, ?)");
    $resultado = $guardar->execute([$descripcion, $fecha, $id_mascota, $id_veterinaria]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./listado.php';</script>";
    }
    
}