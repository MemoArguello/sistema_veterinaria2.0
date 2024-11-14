<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include('../db/db.php');
        $id = $_GET["id"];
        $estado = 0;
        $sentencia = $conexion->prepare("UPDATE compras SET estado=? WHERE id_compras = ?;");
        $resultado = $sentencia->execute([$estado, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Compra Eliminada');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Compra No Eliminada');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>