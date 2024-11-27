<?php
include "../db/db.php";

if (empty($_POST["id_producto"]) || empty($_POST["id_proveedor"]) || empty($_POST["cantidad"]) || empty($_POST["precio_compra"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $producto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];
    $stockActual = $_POST["stock"];
    $estado_caja = "Abierto";

    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se registro una compra";

    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    $stock = $stockActual + $cantidad;

    $sentencia_stock = $conexion->prepare("UPDATE producto SET stock=? WHERE id_producto = ?");
    $resultado_stock = $sentencia_stock->execute([$stock, $producto]);

    
    $proveedor = $_POST["id_proveedor"];
    $precio_compra = $_POST["precio_compra"];
    $total_pagar = $cantidad * $precio_compra;
    
    $ingreso_actual = $_POST["ingreso"];
    $nuevo_ingreso = $ingreso_actual + $total_pagar;

    $sentencia_caja = $conexion->prepare("UPDATE caja SET egreso=? WHERE estado_caja = ?");
    $resultado_caja = $sentencia_caja->execute([$nuevo_ingreso, $estado_caja]);

    $guardar = $conexion->prepare("INSERT INTO compras (id_producto, id_proveedor, cantidad, precio_compra, total_gasto) VALUES (?, ?, ?, ?, ?)");
    $resultado = $guardar->execute([$producto, $proveedor, $cantidad, $precio_compra, $total_pagar]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se registro correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        echo "<script>alert('No se registro correctamente');
                window.location.href='./listado.php';</script>";
    }
    
}