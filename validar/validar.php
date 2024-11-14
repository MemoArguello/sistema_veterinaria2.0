<?php
    session_start();
    include "../db/db.php";
    if (isset($_POST['email']) && isset($_POST['codigo'])) {
        $email = $_POST['email']; 
        $codigo = $_POST['codigo'];

        $consultas = $conexion->prepare("SELECT * FROM usuario WHERE email=:email AND codigo=:codigo");
        $consultas->execute([':email' => $email, ':codigo' => $codigo]);

        $resultado = $consultas->fetch(PDO::FETCH_ASSOC);


        if ($resultado) {
            header("Location: ../menu/menu.php");
            $_SESSION['id_usuario'] = $resultado['id_usuario'];

        } else {
            echo "<script>alert('No existe cuenta');
                window.location.href='../index.php';</script>";
        }
    } else {
        echo "<script>alert('Rellene todos los campos');
                window.location.href='../index.php';</script>";
    }
