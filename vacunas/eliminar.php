<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include('../db/db.php');
        $id = $_GET["id"];
        $estado = 0;
        $sentencia = $conexion->prepare("UPDATE vacunas SET estado=? WHERE id_vacunas = ?;");
        $resultado = $sentencia->execute([$estado, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Vacuna Eliminado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Vacuna No Eliminado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>