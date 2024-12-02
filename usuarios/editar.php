<?php
include "../db/db.php";

// Validar que todos los campos requeridos estén presentes
if (empty($_POST["id_usuario"]) || empty($_POST["nombre"]) || empty($_POST["email"]) || empty($_POST["codigo"]) || empty($_POST["codigo2"]) || empty($_POST["id_cargo"])) {
    echo "<script>alert('Por favor, rellene todos los campos');
                window.location.href='./editar.php';</script>";
    exit;
}

// Recibir y limpiar datos
$id_usuario = intval($_POST["id_usuario"]);
$nombre = trim($_POST["nombre"]);
$email = trim($_POST["email"]);
$codigo = trim($_POST["codigo"]);
$codigo2 = trim($_POST["codigo2"]);
$id_cargo = intval($_POST["id_cargo"]);

// Validar que las contraseñas coincidan
if ($codigo !== $codigo2) {
    echo "<script>alert('Las contraseñas no coinciden');
                window.location.href='./editar.php';</script>";
    exit;
}

// Validar formato del email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('El email no tiene un formato válido');
                window.location.href='./editar.php';</script>";
    exit;
}

// Encriptar la contraseña con MD5
$codigo_encriptado = md5($codigo);

try {
    // Actualizar el usuario en la base de datos
    $editar = $conexion->prepare("UPDATE usuario SET nombre = :nombre, email = :email, codigo = :codigo, id_cargo = :id_cargo WHERE id_usuario = :id_usuario");
    $resultado = $editar->execute([
        ':nombre' => $nombre,
        ':email' => $email,
        ':codigo' => $codigo_encriptado,
        ':id_cargo' => $id_cargo,
        ':id_usuario' => $id_usuario
    ]);

    if ($resultado) {
        echo "<script>alert('Usuario editado correctamente');
                window.location.href='./listado.php';</script>";
    } else {
        echo "<script>alert('Error al editar el usuario');
                window.location.href='./editar.php';</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "');
                window.location.href='./editar.php';</script>";
}
?>
