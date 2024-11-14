<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../db/db.php";
        $id = $_POST["id_cliente"];
        $nombre = $_POST["nombre"];
        $cedula_ruc = $_POST["cedula_ruc"];

        $id_usuario = $_POST["id_usuario"];
        $informacion = "Se edito un cliente";
    
        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        $sentencia = $conexion->prepare("UPDATE cliente SET nombre=?, cedula_ruc=? WHERE id_cliente = ?;");
        $resultado = $sentencia->execute([$nombre, $cedula_ruc, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Cliente Editado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Cliente no Editado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>