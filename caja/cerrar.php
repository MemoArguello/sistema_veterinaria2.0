<?php
include "../db/db.php";

if (empty($_POST["fecha_cierre"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $fecha_cierre = $_POST["fecha_cierre"];
    $id_caja = $_POST["id_caja"];
    $estado_caja = "Cerrado";
    $egreso = $_POST["egreso"];
    $ingreso = $_POST["ingreso"];

    $monto_cierre = $egreso + $ingreso;
    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se dio Cierre a una caja";


        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        $guardar = $conexion->prepare("UPDATE caja SET fecha_cierre=?, estado_caja=?, saldo_cierre=? WHERE id_caja = ?");
        $resultado = $guardar->execute([$fecha_cierre, $estado_caja, $monto_cierre, $id_caja]);

        if ($resultado === TRUE) {
            echo "<script>alert('Se Cerró correctamente la caja');
                    window.location.href='./listado.php';</script>";
        } else {
            echo "<script>alert('No se pudo registrar la caja');
                    window.location.href='./listado.php';</script>";
        }
}
?>