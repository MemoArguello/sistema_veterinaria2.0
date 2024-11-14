<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../db/db.php";
        $id = $_POST["id_veterinaria"];
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $registro = $_POST["registro"];

        $id_usuario = $_POST["id_usuario"];
        $informacion = "Se edito un veterinario";
    
        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        $sentencia = $conexion->prepare("UPDATE veterinario SET nombre=?, telefono=?, registro=? WHERE id_veterinaria = ?;");
        $resultado = $sentencia->execute([$nombre, $telefono, $registro, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Veterinario Editado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Veterinario no Editado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>
