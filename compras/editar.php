<?php
include "../db/db.php";

if (empty($_POST["id_producto"]) || empty($_POST["id_proveedor"]) || empty($_POST["cantidad"]) || empty($_POST["precio_compra"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
} else {
    $id_compras = $_POST["id_compras"];
    $producto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];
    $stockActual = $_POST["stock"];

    $id_usuario = $_POST["id_usuario"];
    $informacion = "Se edito una compra";

    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    $stock = $stockActual + $cantidad;

    $sentencia_stock = $conexion->prepare("UPDATE producto SET stock=? WHERE id_producto = ?");
    $resultado_stock = $sentencia_stock->execute([$stock, $producto]);

    $proveedor = $_POST["id_proveedor"];
    $precio_compra = $_POST["precio_compra"];
    $total_pagar = $cantidad * $precio_compra;

    $sentencia = $conexion->prepare("UPDATE compras SET id_producto=?, id_proveedor=?, cantidad=?,  precio_compra=?, total_gasto=?  WHERE id_compras = ?;");
    $resultado = $sentencia->execute([$producto, $proveedor, $cantidad, $precio_compra, $total_pagar, $id_compras]);
    if ($resultado === TRUE) {
        echo "<script>alert('Se edito correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        echo "<script>alert('No se edito correctamente');
                window.location.href='./listado.php';</script>";
    }

}
