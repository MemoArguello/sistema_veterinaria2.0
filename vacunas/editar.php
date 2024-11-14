<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../db/db.php";
        $id = $_POST["id_vacunas"];
        $nombre = $_POST["nombre"];

        $id_usuario = $_POST["id_usuario"];
        $informacion = "Se edito una vacuna";
    
        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        $sentencia = $conexion->prepare("UPDATE vacunas SET nombre=? WHERE id_vacunas = ?;");
        $resultado = $sentencia->execute([$nombre, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Vacuna Editado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Vacuna no Editado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>
