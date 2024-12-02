<?php
include "../db/db.php";

if (empty($_POST["id_producto"]) || empty($_POST["id_proveedor"]) || empty($_POST["cantidad"]) || empty($_POST["precio_compra"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $consulta = $conexion->query("SELECT * FROM caja WHERE estado_caja = 'Abierto'");
    $consulta->execute();
    $caja = $consulta->fetch(PDO::FETCH_OBJ);

    if (!$caja) {
        echo "<script>alert('Debe abrir una caja antes de realizar la compra');
                window.location.href='./listado.php';</script>";
    } else {
        $producto = $_POST["id_producto"];
        $cantidad = $_POST["cantidad"];
        $stockActual = $_POST["stock"];
        $estado_caja = "Abierto"; // Mantener la caja como abierta

        $id_usuario = $_POST["id_usuario"];
        $informacion = "Se registro una compra";

        $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
        $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

        // Actualizacion de stock
        $sentencia = $conexion->prepare("SELECT stock FROM producto WHERE id_producto = :id_producto AND id_proveedor IS NOT NULL");
        $sentencia->execute([':id_producto' => $producto]);
        $stockActual = $sentencia->fetch(PDO::FETCH_OBJ);
        
        if (!$stockActual) {
            die("Producto no encontrado.");
        }
        
        $nuevo_stock = $stockActual->stock + $cantidad;
        
        if ($nuevo_stock < 0) {
            die("No hay suficiente stock para completar la operación.");
        }
        
        $sentencia_stock = $conexion->prepare("UPDATE producto SET stock = :nuevo_stock WHERE id_producto = :id_producto");
        $resultado_stock = $sentencia_stock->execute([
            ':nuevo_stock' => $nuevo_stock,
            ':id_producto' => $producto
        ]);
        
        // Actualizacion de stock

        $proveedor = $_POST["id_proveedor"];
        $precio_compra = $_POST["precio_compra"];
        $total_pagar = $cantidad * $precio_compra;

        $egreso_actual = $_POST["egreso"];
        $nuevo_ingreso = $egreso_actual + $total_pagar;

        $sentencia_caja = $conexion->prepare("UPDATE caja SET egreso=? WHERE estado_caja = ?");
        $resultado_caja = $sentencia_caja->execute([$nuevo_ingreso, $estado_caja]);

        $guardar = $conexion->prepare("INSERT INTO compras (id_producto, id_proveedor, cantidad, precio_compra, total_gasto) VALUES (?, ?, ?, ?, ?)");
        $resultado = $guardar->execute([$producto, $proveedor, $cantidad, $precio_compra, $total_pagar]);

        if ($resultado === true) {
            echo "<script>alert('Se registro correctamente');
                    window.location.href='./listado.php';</script>";
        } else {
            echo "<script>alert('No se registro correctamente');
                    window.location.href='./listado.php';</script>";
        }
    }
}
?>
