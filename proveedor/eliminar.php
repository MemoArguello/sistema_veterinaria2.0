<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include('../db/db.php');
        $id = $_GET["id"];
        $estado = 0;
        $sentencia = $conexion->prepare("UPDATE proveedor SET estado=? WHERE id_proveedor = ?;");
        $resultado = $sentencia->execute([$estado, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Proveedor Eliminado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Proveedor No Eliminado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>