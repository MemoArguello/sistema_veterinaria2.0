<?php
session_start();
include "../db/db.php";

if (isset($_POST['email']) && isset($_POST['codigo'])) {
    // Limpiar entradas
    $email = trim($_POST['email']);
    $codigo = trim($_POST['codigo']);

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($codigo)) {
        echo "<script>alert('Rellene todos los campos');
                window.location.href='../index.php';</script>";
        exit;
    }

    // Encriptar la contraseña ingresada con MD5
    $codigo_encriptado = md5($codigo);

    // Consulta preparada
    $consulta = $conexion->prepare("SELECT * FROM usuario WHERE email = :email AND codigo = :codigo");
    $consulta->execute([':email' => $email, ':codigo' => $codigo_encriptado]);

    // Verificar si hay un resultado
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        // Iniciar sesión y redirigir
        $_SESSION['id_usuario'] = $resultado['id_usuario'];
        header("Location: ../inicio/inicio.php");
    } else {
        echo "<script>alert('No existe cuenta');
                window.location.href='../index.php';</script>";
    }
} else {
    echo "<script>alert('Rellene todos los campos');
            window.location.href='../index.php';</script>";
}
?>