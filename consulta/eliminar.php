<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include('../db/db.php');
        $id = $_GET["id"];
        $estado = 0;
        $sentencia = $conexion->prepare("UPDATE consultas SET estado=? WHERE id_consultas = ?;");
        $resultado = $sentencia->execute([$estado, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Consulta Eliminada');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Consulta No Eliminada');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>