<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include('../db/db.php');
        $id = $_GET["id"];
        $estado = 0;
        $sentencia = $conexion->prepare("UPDATE categoria SET estado=? WHERE id_categoria = ?;");
        $resultado = $sentencia->execute([$estado, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Categoria Eliminado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Categoria No Eliminado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>