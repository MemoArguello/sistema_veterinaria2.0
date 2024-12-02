<?php
require "../menu/menu.php";
require "../db/db.php";


$consulta = $conexion->query("SELECT usuario.*, roles.descripcion FROM usuario JOIN roles ON roles.id_rol = usuario.id_cargo WHERE usuario.estado=1");
$consulta->execute();

$usuarios = $consulta->fetchAll(PDO::FETCH_OBJ);
$PaginaActual = basename($_SERVER['PHP_SELF']);

?>
<div class="container-principal">

    <div class="topnav" id="myTopnav">
        <a href="../inicio/inicio.php" class="<?php echo ($PaginaActual == 'inicio.php') ? 'active' : ''; ?>">Estadísticas</a>
        <a href="../inicio/auditoria.php" class="<?php echo ($PaginaActual == 'auditoria.php') ? 'active' : ''; ?>">Auditoría</a>
        <a href="./listado.php" class="<?php echo ($PaginaActual == 'listado.php') ? 'active' : ''; ?>">Usuarios</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="container_listado-venta">
        <h1>Usuarios Registrados</h1>
        <a class="botonReporte" href="<?= $Direccion ?>usuarios/usuario_pdf.php" target="_blank">
            <i class="fas fa-file"></i> Reporte PDF
            <a class="botonGuardar" href="<?= $Direccion ?>usuarios/nuevo.php">
                <i class="fas fa-plus"></i> Registrar
            </a>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Cargo</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <?php $i = 1;
                    foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $usuario->nombre ?></td>
                    <td><?= $usuario->descripcion ?></td>
                    <td><?= $usuario->email ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn">Opciones</button>
                            <div class="dropdown-content">
                                <a href="editar_frm.php?id=<?= $usuario->id_usuario ?>">Editar</a>
                                <a href="eliminar.php?id=<?= $usuario->id_usuario ?>">Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tr>
            </table>
    </div>
</div>