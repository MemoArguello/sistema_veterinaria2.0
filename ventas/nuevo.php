<?php require "../menu/menu.php" ?>
<?php require "../db/db.php" ?>
<?php


$query4 = $conexion->prepare("SELECT * FROM categoria WHERE estado=1");
$query4->execute();
$resultado4 = $query4->fetchAll(PDO::FETCH_ASSOC);

$id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : '';

$query3 = $conexion->prepare("SELECT * FROM producto WHERE id_categoria = :id_categoria");
$query3->bindParam(':id_categoria', $id_categoria);
$query3->execute();

$resultado3 = $query3->fetchAll(PDO::FETCH_ASSOC);
// Consulta para obtener categorías
$query = $conexion->prepare("SELECT * FROM categoria");
$query->execute();
$resultado2 = $query->fetchAll(PDO::FETCH_ASSOC);
$PaginaActual = basename($_SERVER['PHP_SELF']);

$consulta = $conexion->query("SELECT * FROM caja WHERE estado_caja = 'Abierto'");
$consulta->execute();

$caja = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="container-venta2">
    <div class="topnav" id="myTopnav">
        <a href="./nuevo.php" class="<?php echo ($PaginaActual == 'nuevo.php') ? 'active' : ''; ?>">Formulario de Ventas</a>
        <a href="./listado.php" class="<?php echo ($PaginaActual == 'listado.php') ? 'active' : ''; ?>">Listado de Ventas</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="formulario-venta-container">
        <?php if ($caja): ?>
            <input type="hidden" id="ingreso" name="ingreso" value="<?= $caja->ingreso ?>">
            <?php else: ?>
            <input type="hidden" id="ingreso" name="ingreso" value="0">
        <?php endif; ?>
        <h2 class="formulario-venta-titulo">Registrar Venta</h2>

        <div class="formulario-venta-field">
            <label for="ciCliente" class="formulario-venta-label">Cédula del Cliente</label>
            <input type="text" id="ciCliente" name="cedula" placeholder="Cédula" required class="formulario-venta-input">
            <button class="formulario-venta-boton" onclick="consultarCliente();">Buscar</button>
        </div>

        <div class="formulario-venta-field">
            <label for="nombreCliente" class="formulario-venta-label">Nombre del Cliente</label>
            <input type="text" id="nombreCliente" readonly class="formulario-venta-input-second">
            <button class="formulario-venta-boton2" onclick="insertarFactura();">Iniciar Factura</button>
        </div>

        <div class="formulario-venta-field">
            <label for="numeroFactura" class="formulario-venta-label">Número de Factura</label>
            <input type="text" id="numeroFactura" name="id_factura_cabecera" readonly class="formulario-venta-input-second">
        </div>

        <div class="input-field">
            <label for="id_categoria" class="label">Categoría</label>
            <select name="categoria" id="categoria" onchange="cargarProductos(this.value)" required>
                <option value="" disabled selected>Selecciona una categoria</option>
                <?php
                foreach ($resultado4 as $categoria) {
                    echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['nombre_categoria'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="input-field">
            <label for="id_producto" class="label">Producto</label>
            <select name="producto[]" id="id_producto" required>
                <option value="" disabled selected>Selecciona primero la categoría</option>

            </select>
        </div>
        <div class="formulario-venta-field">
            <label for="txtCantidad" class="formulario-venta-label">Cantidad</label>
            <input type="text" id="txtCantidad" name="cantidad" placeholder="Cantidad" class="formulario-venta-input">
            <button class="formulario-venta-boton" onclick="consultarProducto();" id="btnAgregar">Agregar</button>
        </div>

        <div class="formulario-venta-table-container">
            <table id="customers" class="formulario-venta-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="resultadoProducto">

                </tbody>
            </table>
        </div>

        <table class="formulario-venta-table">
            <tfoot>
                <tr>
                    <th id="subtotal">Sub Total:</th>
                    <th id="iva">IVA %:</th>
                    <th id="total">Total Factura:</th>
                </tr>
            </tfoot>
        </table>

        <div class="formulario-venta-field">
            <button class="formulario-venta-boton" onclick="imprimirFactura();" id="btnImprimir">Finalizar e Imprimir</button>
        </div>
    </div>
</div>

<script>
    var id = 0;
    var idFactura = 0;
    var Total = 0;
    var subTotalGeneral = 0;

    function cargarProductos(categoria) {
        // Verificar que la categoría sea válida antes de continuar
        if (!categoria) {
            document.getElementById("id_producto").innerHTML = '<option value="">Seleccione primero la categoría</option>';
            return;
        }

        // Realizar solicitud AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    try {
                        // Procesar la respuesta y actualizar el select de productos
                        var productos = JSON.parse(this.responseText);
                        var options = '<option value="">Seleccione una opción</option>'; // Opción en blanco
                        for (var i = 0; i < productos.length; i++) {
                            options += '<option value="' + productos[i].id_producto + '">' + productos[i].nombre_producto + '</option>';
                        }
                        document.getElementById("id_producto").innerHTML = options;
                    } catch (error) {
                        console.error("Error procesando la respuesta JSON:", error);
                        alert("Error al cargar los productos. Intente nuevamente.");
                    }
                } else {
                    console.error("Error en la solicitud AJAX:", this.statusText);
                    alert("Error al cargar los productos. Intente más tarde.");
                }
            }
        };
        xhttp.open("GET", "get_producto.php?id_categoria=" + encodeURIComponent(categoria), true);
        xhttp.send();
    }


    function cancelarFactura() {
        var numeroFactura = document.getElementById("numeroFactura").value;
        $.ajax({
            url: 'eliminar_factura.php',
            method: 'POST',
            data: {
                id_factura: numeroFactura
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    alert("Factura cancelada Correctamente")
                } else {
                    alert("Error al cancela la factura" + data.error)
                }
            }
        })

        // Limpiar los campos después de agregar
        document.getElementById("ciCliente").value = "";
        document.getElementById("nombreCliente").value = "";
        document.getElementById("numeroFactura").value = "";
    }

    function imprimirFactura() {
        var numeroFactura = document.getElementById("numeroFactura").value;

        // Validar si numeroFactura está vacío
        if (numeroFactura.trim() === "") {
            alert("Debe crear una factura primero");
            return; // Salir de la función si no hay numeroFactura
        }

        // Realizar petición AJAX a ticket.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./RECEIPT/factura.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.responseType = 'blob'; // Esperamos una respuesta tipo blob (archivo)

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("Factura generada correctamente");

                // Crear URL del objeto blob
                var blob = new Blob([xhr.response], {
                    type: 'application/pdf'
                });
                var url = URL.createObjectURL(blob);

                // Abrir el PDF generado en una nueva ventana
                window.open(url, '_blank');
            }
        };
        xhr.send("id=" + numeroFactura);

        // Limpiar los campos después de agregar
        document.getElementById("ciCliente").value = "";
        document.getElementById("nombreCliente").value = "";
        document.getElementById("numeroFactura").value = "";
        let table = document.getElementById("customers");
        let tbody = table.getElementsByTagName("tbody")[0];

        // Limpiar las filas de la tabla
        tbody.innerHTML = "";
    }


    function consultarCliente() {
        var ciCliente = document.getElementById("ciCliente").value.trim();

        if (ciCliente === "") {
            alert("Debe ingresar la cédula del cliente.");
            return;
        }

        $.ajax({
            url: 'consultar_cliente.php',
            method: 'POST',
            data: {
                ciCliente: ciCliente
            },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                } else {
                    document.getElementById("nombreCliente").value = data.nombre;
                    id = data.id_cliente;
                }
            },
            error: function() {
                alert("Error en la solicitud al servidor.");
            }
        });
    }


    function insertarFactura() {
        $.ajax({
            url: 'procesar_factura.php',
            method: 'POST',
            data: {
                id_cliente: id
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    var id_cabecera = data.id_cabecera
                    document.getElementById("numeroFactura").value = data.id_cabecera;
                    idFactura = id_cabecera;
                } else {
                    alert("Error al insertar la factura" + data.error)
                }
            }
        })
    }

    function consultarProducto() {
        var id_producto = document.getElementById("id_producto").value;
        var cant = document.getElementById("txtCantidad").value;

        // Validar si cantidad está vacío
        if (cant.trim() === "") {
            alert("Debe agragar la cantidad primero");
            return;
        }


        $.ajax({
            url: 'cargar_productos.php',
            method: 'post',
            data: {
                id_producto: id_producto
            },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error)
                } else {
                    var resultadoProducto = document.getElementById("resultadoProducto")
                    var fila = document.createElement("tr")
                    let subtotal = data.precio * cant;
                    subTotalGeneral += subtotal;
                    Iva = 0;
                    total = subTotalGeneral += Iva;
                    insertarFactura_detalle(idFactura, data.id_producto, cant, data.precio, subtotal);
                    fila.innerHTML = "<td>" + data.id_producto + "</td><td>" + data.nombre_producto + "</td><td>" + data.precio.toLocaleString() + "</td><td>" + cant + "</td><td>" + subtotal.toLocaleString() + "</td>";
                    resultadoProducto.appendChild(fila);
                    document.getElementById("subtotal").innerText = "Sub Total: " + subTotalGeneral.toLocaleString();
                    document.getElementById("iva").innerText = "IVA %: " + Iva.toLocaleString();
                    document.getElementById("total").innerText = "Total Factura: " + total.toLocaleString();
                }
            }
        });
        // Limpiar los campos después de agregar
        document.getElementById("id_producto").value = "";
        document.getElementById("txtCantidad").value = "";
    }

    function insertarFactura_detalle(id_factura_cabecera, producto, cantidad, precio, subtotal) {
        const ingreso = document.getElementById('ingreso').value;

        $.ajax({
            url: 'guardar_detalle_factura.php',
            method: 'POST',
            data: {
                id_factura_cabecera: id_factura_cabecera,
                id_producto: producto,
                cantidad: cantidad,
                precio: precio,
                subtotal: subtotal,
                ingreso: ingreso
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    alert("Producto agregado Correctamente");
                } else {
                    alert("Error al insertar el producto: " + data.error);
                }
            }
        });
    }
</script>