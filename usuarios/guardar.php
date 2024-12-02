<?php
include "../db/db.php";

if (empty($_POST["nombre"]) || empty($_POST["email"]) || empty($_POST["codigo"]) || empty($_POST["codigo2"]) || empty($_POST["id_cargo"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./nuevo.php';</script>";
    exit;
}

$nombre = trim($_POST["nombre"]);
$email = trim($_POST["email"]);
$codigo = trim($_POST["codigo"]);
$codigo2 = trim($_POST["codigo2"]);
$id_cargo = intval($_POST["id_cargo"]);
$id_usuario = intval($_POST["id_usuario"]);
$informacion = "Se registró un usuario";

// Validar que los correos coincidan
if ($codigo !== $codigo2) {
    echo "<script>alert('Las contraseñas no coinciden');
                window.location.href='./nuevo.php';</script>";
    exit;
}

// Validar formato de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('El email no tiene un formato válido');
                window.location.href='./nuevo.php';</script>";
    exit;
}

// Encriptar la contraseña con MD5
$codigo_encriptado = md5($codigo);

try {
    // Iniciar transacción
    $conexion->beginTransaction();

    // Insertar en la tabla auditoría
    $auditoria = $conexion->prepare("INSERT INTO auditoria (id_usuario, informacion) VALUES (?, ?)");
    $resultado_auditoria = $auditoria->execute([$id_usuario, $informacion]);

    // Insertar en la tabla usuario
    $guardar = $conexion->prepare("INSERT INTO usuario (nombre, email, codigo, id_cargo) VALUES (?, ?, ?, ?)");
    $resultado = $guardar->execute([$nombre, $email, $codigo_encriptado, $id_cargo]);

    if ($resultado && $resultado_auditoria) {
        // Confirmar transacción
        $conexion->commit();
        echo "<script>alert('Se registró correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        // Revertir transacción en caso de error
        $conexion->rollBack();
        echo "<script>alert('No se registró correctamente');
                window.location.href='./listado.php';</script>";
    }
} catch (Exception $e) {
    // Manejar errores
    $conexion->rollBack();
    echo "<script>alert('Error: " . $e->getMessage() . "');
                window.location.href='./listado.php';</script>";
}
?>
