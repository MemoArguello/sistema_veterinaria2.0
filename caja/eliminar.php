<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include('../db/db.php');
        $id = $_GET["id"];
        $estado = 0;
        $estado_caja = "Cerrado";
        $sentencia = $conexion->prepare("UPDATE caja SET estado=?, estado_caja=? WHERE id_caja = ?;");
        $resultado = $sentencia->execute([$estado, $estado_caja, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Caja Eliminado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Caja No Eliminado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>