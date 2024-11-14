<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../db/db.php";
        $id = $_POST["id_consultas"];
        $descripcion = $_POST["descripcion"];
        $fecha = $_POST["fecha"];
        $id_mascota = $_POST["id_mascota"];
        $id_veterinaria = $_POST["id_veterinaria"];

        $id_usuario = $_POST["id_usuario"];
        $informacion = "Se edito una consulta";
    
        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        $sentencia = $conexion->prepare("UPDATE consultas SET descripcion=?, fecha=?, id_mascota=?, id_veterinaria=? WHERE id_consultas = ?;");
        $resultado = $sentencia->execute([$descripcion, $fecha, $id_mascota, $id_veterinaria, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Consulta Editada');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Consulta no Editada');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>
