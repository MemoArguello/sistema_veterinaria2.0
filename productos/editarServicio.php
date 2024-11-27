<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../db/db.php";
        $id = $_POST["id_producto"];
        $nombre = $_POST["nombre_producto"];
        $precio = $_POST["precio"];
        $categoria = $_POST["id_categoria"];
        
        $id_usuario = $_POST["id_usuario"];
        $informacion = "Se edito un Servicio";
    
        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        $sentencia = $conexion->prepare("UPDATE producto SET nombre_producto=?, precio=?, id_categoria=? WHERE id_producto = ?;");
        $resultado = $sentencia->execute([$nombre, $precio, $categoria, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Servicio Editado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Servicio no Editado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>
