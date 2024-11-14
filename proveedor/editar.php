<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../db/db.php";
        $id = $_POST["id_proveedor"];
        $nombre = $_POST["nombre_proveedor"];
        $ruc_proveedor = $_POST["ruc_proveedor"];

        $id_usuario = $_POST["id_usuario"];
        $informacion = "Se edito un proveedor";
    
        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        $sentencia = $conexion->prepare("UPDATE proveedor SET nombre_proveedor=?, ruc_proveedor=? WHERE id_proveedor = ?;");
        $resultado = $sentencia->execute([$nombre, $ruc_proveedor, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Proveedor Editado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Proveedor no Editado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>