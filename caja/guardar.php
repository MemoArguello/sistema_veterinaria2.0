<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include "../db/db.php";

if (empty($_POST["fecha_apertura"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $fecha_apertura = $_POST["fecha_apertura"];
    $fecha_actual = date('Y-m-d');

    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se dio apertura a una caja";

    $verificar = $conexion->prepare("SELECT COUNT(*) FROM caja WHERE estado_caja = 'abierto'");
    $verificar->execute();
    $caja_abierta = $verificar->fetchColumn();

    if ($caja_abierta > 0) {
        echo "<script>alert('Ya hay una caja abierta. Cierre la caja existente antes de abrir una nueva.');
                window.location.href='./listado.php';</script>";
    } else {
        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        if ($fecha_apertura >= $fecha_actual) {
            $guardar = $conexion->prepare("INSERT INTO caja (fecha_apertura, estado_caja) VALUES (?, 'Abierto')");
            $resultado = $guardar->execute([$fecha_apertura]);

            if ($resultado === TRUE) {
                echo "<script>alert('Se registró correctamente la caja');
                        window.location.href='./listado.php';</script>";
            } else {
                echo "<script>alert('No se pudo registrar la caja');
                        window.location.href='./listado.php';</script>";
            }
        } else {
            echo "<script>alert('La fecha de apertura no puede ser una fecha pasada.');
                    window.location.href='./nuevo.php';</script>";
        }

    }
}
