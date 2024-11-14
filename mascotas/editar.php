<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../db/db.php";
        $id = $_POST["id_mascota"];
        $nombre = $_POST["nombre"];
        $especie = $_POST["especie"];
        $raza = $_POST["raza"];
        $sexo= $_POST["sexo"];

        $id_usuario = $_POST["id_usuario"];
        $informacion = "Se edito una mascota";
    
        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        $sentencia = $conexion->prepare("UPDATE mascota SET nombre=?, especie=?, raza=?, sexo=?  WHERE id_mascota = ?;");
        $resultado = $sentencia->execute([$nombre, $especie, $raza, $sexo, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Mascota Editado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Mascota no Editado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>
