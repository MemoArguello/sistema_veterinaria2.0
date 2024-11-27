<?php
include '../db/db.php';
try{
    $id_factura_cabecera = $_POST["id_factura_cabecera"];
    $id_producto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];
    $precio_unitario = $_POST["precio"];
    $total_pagar = $_POST["subtotal"];
    $estado = 1;
    $estado_caja = "Abierto";
    $ingreso_actual = $_POST["ingreso"];

    $nuevo_ingreso = $ingreso_actual + $total_pagar;

    $sentencia_caja = $conexion->prepare("UPDATE caja SET ingreso=? WHERE estado_caja = ?");
    $resultado_caja = $sentencia_caja->execute([$nuevo_ingreso, $estado_caja]);

    $stmt = $conexion->prepare("INSERT INTO factura_detalle (id_cabecera, id_producto, cantidad, precio_unitario, total_pagar) VALUES (:id_cabecera, :id_producto, :cantidad, :precio_unitario, :total_pagar)");
    $stmt->bindParam(':id_cabecera',$id_factura_cabecera, PDO::PARAM_INT);
    $stmt->bindParam(':id_producto',$id_producto, PDO::PARAM_INT);
    $stmt->bindParam(':cantidad',$cantidad, PDO::PARAM_INT);
    $stmt->bindParam(':precio_unitario',$precio_unitario, PDO::PARAM_STR);
    $stmt->bindParam(':total_pagar',$total_pagar, PDO::PARAM_STR);

    $stmt->execute();

    $query = $conexion->prepare("UPDATE factura_cabecera SET estado = :estado WHERE id_cabecera = :id_cabecera");
    $query->bindParam(':estado',$estado, PDO::PARAM_INT);
    $query->bindParam(':id_cabecera',$id_factura_cabecera, PDO::PARAM_INT);

    $query->execute();

    echo json_encode(array('success'=>true));

}catch (PDOException $e){
    echo json_encode(array('success'=>'False', 'error'=>'Error al Insertar la factura'.$e->getMessage()));
}
?>