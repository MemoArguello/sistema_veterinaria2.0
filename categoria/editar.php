<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "../db/db.php";
        $id = $_POST["id_categoria"];
        $nombre = $_POST["nombre_categoria"];
        $sentencia = $conexion->prepare("UPDATE categoria SET nombre_categoria=? WHERE id_categoria = ?;");
        $resultado = $sentencia->execute([$nombre, $id]);
        if($resultado === TRUE) {
            echo "<script>alert('Categoria Editado');
            window.location.href='./listado.php'</script>";
        } else {
            echo "<script>alert('Categoria no Editado');
            window.location.href='./listado.php'</script>";
        }
    }
} catch (Exception $e) {
    echo($e);
}
?>
