<?php
session_start();
$Direccion = "http://localhost/sistema_veterinaria/";
date_default_timezone_set('America/Argentina/Buenos_Aires');

if (!isset($_SESSION['id_usuario'])) {
  header("location:".$Direccion);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Veterinaria</title>

  <!-- CSS -->
  <link rel="stylesheet" href="<?= $Direccion ?>css/style.css" />

  <!-- ===== Iconscout CSS ===== -->
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="../img/pet.webp">
</head>

<body>
  <nav>
    <div class="logo">
      <img src="<?= $Direccion ?>img/menu2.png" alt="" class="bx bx-menu menu-icon">
      <span class="logo-name">VETERINARIA</span>
    </div>

    <div class="sidebar">
      <div class="logo">
      <img src="<?= $Direccion ?>img/menu.png" alt="" class="bx bx-menu menu-icon">
        <span class="logo-sidebar">VETERINARIA</span>
      </div>

      <div class="sidebar-content">
        <ul class="lists">
        <li class="list">
            <a href="<?= $Direccion ?>inicio/inicio.php" class="nav-link">
              <img src="<?= $Direccion ?>img/inicio.png" alt="">
              <span class="link">Inicio</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>cliente/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/clientes.png" alt="">
              <span class="link">Clientes</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>mascotas/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/mascotas.png" alt="">
              <span class="link">Mascotas</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>proveedor/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/proveedor.png" alt="">
              <span class="link">Proveedores</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>categoria/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/categoria.png" alt="">
              <span class="link">Categorias</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>productos/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/productos.png" alt="">
              <span class="link">Productos</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>veterinarios/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/veterinario.png" alt="">
              <span class="link">Veterinarios</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>consulta/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/consultas.png" alt="">
              <span class="link">Consultas</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>vacunas/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/vacunas.png" alt="">
              <span class="link">Vacunas</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>caja/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/caja.png" alt="">
              <span class="link">Caja</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>ventas/nuevo.php" class="nav-link">
              <img src="<?= $Direccion ?>img/ventas.png" alt="">
              <span class="link">Ventas</span>
            </a>
          </li>

          <li class="list">
            <a href="<?= $Direccion ?>compras/listado.php" class="nav-link">
              <img src="<?= $Direccion ?>img/compra.png" alt="">
              <span class="link">Compras</span>
            </a>
          </li>
          <div class="bottom-cotent">
            <li class="list">
              <a href="<?= $Direccion ?>validar/cerrar_sesion.php" class="nav-link">
                <img src="<?= $Direccion ?>img/lagout.png" alt="">
                <span class="link">Cerrar Sesión</span>
              </a>
            </li>
          </div>
        </ul>

      </div>
    </div>
  </nav>

  <section class="overlay"></section>

  <script>
    const navBar = document.querySelector("nav"),
      menuBtns = document.querySelectorAll(".menu-icon"),
      overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
      menuBtn.addEventListener("click", () => {
        navBar.classList.toggle("open");
      });
    });

    overlay.addEventListener("click", () => {
      navBar.classList.remove("open");
    });
  </script>
</body>

</html>