<?php
include '../db/db.php';

try{
    $id_producto = $_POST["id_producto"];
    $stmt = $conexion->prepare("SELECT * FROM producto WHERE id_producto =:id_producto");
    $stmt->bindParam(':id_producto',$id_producto, PDO::PARAM_INT);
    $stmt->execute();

    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if($producto){
        echo json_encode($producto);
    }else{
        echo json_encode(array('error'=>'producto no encontrado'));
    }
}catch (PDOException $e){
    echo json_encode(array('error'=>'Error de conexión'.$e->getMessage()));
}
?>
