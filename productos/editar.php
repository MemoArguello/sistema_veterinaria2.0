<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../db/db.php";
        $id = $_POST["id_producto"];
        $nombre = $_POST["nombre_producto"];
        $stock = $_POST["stock"];
        $precio = $_POST["precio"];
        $categoria = $_POST["id_categoria"];
        $proveedor = $_POST["id_proveedor"];
        
        $id_usuario = $_POST["id_usuario"];
        $informacion = "Se edito un producto";
    
        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        $sentencia = $conexion->prepare("UPDATE producto SET nombre_producto=?, stock=?, precio=?, id_categoria=?, id_proveedor=? WHERE id_producto = ?;");
        $resultado = $sentencia->execute([$nombre, $stock, $precio, $categoria, $proveedor, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Producto Editado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Producto no Editado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>
