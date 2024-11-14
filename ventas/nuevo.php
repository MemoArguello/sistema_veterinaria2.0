<?php require "../menu/menu.php" ?>
<?php require "../db/db.php" ?>
<?php


$query4 = $conexion->prepare("SELECT * FROM categoria ORDER BY id_categoria");
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

?>
<div class="container-venta">
    <div class="forms">
        <div class="form login">
            <h2 class="title">Registrar Venta</h2>
            <br>
                <label for="nombre" class="label">Cedula del Cliente</label>
                <div class="input-field">
                    <input type="text" id="ciCliente" name="cedula" placeholder="Cedula" required>
                </div>
                <div class="input-field button">
                    <button class="boton" onclick="consultarCliente();">Buscar</button>
                </div>
                <label for="nombre" class="label">Cliente</label>
                <div class="input-field">
                    <input type="text" id="nombreCliente" readonly placeholder="Nombre del Cliente">
                </div>
                <div class="input-field button">
                    <button class="boton" onclick="insertarFactura();">Iniciar Factura</button>
                </div>
                <label for="nombre" class="label">Cliente</label>
                <div class="input-field">
                    <input type="text" id="numeroFactura" name="id_factura_cabecera" readonly>
                </div>
                <div class="left">
                    <h2>Agrega un Productos:</h2>
                </div>
                <div class="input-field">
                    <select name="id_categoria" required>
                        <option value="">Categoria</option>
                        <?php
                        include '../db/db.php';
                        $sentencia = $conexion->query("SELECT * FROM categoria");
                        $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($categorias as $categoria) {
                            echo "<option value='" . $categoria->id_categoria . "'>" . $categoria->nombre_categoria . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-field">
                <select name="producto[]" id="id_producto" required>
                            <option value="" disabled selected>Selecciona primero la categoría</option>
                        </select>
                </div>
                <label for="nombreCliente">Cantidad:</label>
                <div class="input-field">
                <input type="text" id="txtCantidad" name="cantidad" placeholder="Cantidad">
                </div>
                <div class="input-field button">
                    <button class="boton" type="submit">Guardar</button>
                </div>
                <div class="input-field button">
                    <button class="boton" onclick="consultarProducto();" id="btnAgregar">Agregar</button>
                </div>
                <div class="left">
                    <h3>Productos Seleccionados</h3>
                </div>
                <div class="table-container">
                    <table id="customers">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio Unitario</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="resultadoProducto">

                        </tbody>
                    </table>
                </div>
                <table id="customers">
                    <tfoot>
                        <tr>
                            <th id="subtotal">Sub Total:</th>
                            <th id="iva">IVA %:</th>
                            <th id="total">Total Factura:</th>
                        </tr>
                    </tfoot>
                </table>
                <br>
                <div class="left">
                    <h4>Finalizar e Imprimir Factura</h4>
                </div>
                <div class="input-field button">
                    <button class="boton" onclick="imprimirFactura();" id="btnAgregar">Imprimir</button>
                </div>
        </div>
    </div>
</div>


<script>
    var id = 0;
    var idFactura = 0;
    var Total = 0;
    var subTotalGeneral = 0;

    function cargarProductos(categoria) {
        // Realizar solicitud AJAX para obtener las ciudades del departamento seleccionado
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Procesar la respuesta y actualizar el select de ciudades
                var productos = JSON.parse(this.responseText);
                var options = '<option value="">Seleccione una opción</option>'; // Opción en blanco por defecto
                for (var i = 0; i < productos.length; i++) {
                    options += '<option value="' + productos[i].id_producto + '">' + productos[i].nombre_producto + '</option>';
                }
                document.getElementById("id_producto").innerHTML = options;
            }
        };
        xhttp.open("GET", "./get_producto.php?id_categoria=" + categoria, true);
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
        xhr.open("POST", "./RECEIPT/ticket.php", true);
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
        var ciCliente = document.getElementById("ciCliente").value;
        $.ajax({
            url: 'consultar_cliente.php',
            method: 'POST',
            data: {
                ciCliente: ciCliente
            },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error)
                } else {
                    document.getElementById("nombreCliente").value = data.nombre_cliente;
                    id = data.id_cliente;
                }
            }
        })
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
                    var id_factura = data.id_factura
                    document.getElementById("numeroFactura").value = data.id_factura;
                    idFactura = id_factura;
                } else {
                    alert("Error al insertar la factura" + data.error)
                }
            }
        })
    }

    function consultarProducto() {
        var id_producto = document.getElementById("id_producto").value;
        var cant = document.getElementById("txtCantidad").value;

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
                    //Iva = subTotalGeneral *0.19;
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
        $.ajax({
            url: 'guardar_detalle_factura.php',
            method: 'POST',
            data: {
                id_factura_cabecera: id_factura_cabecera,
                id_producto: producto,
                cantidad: cantidad,
                precio: precio,
                subtotal: subtotal
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    alert("Producto agregado Correctamente")
                } else {
                    alert("Error al insertar el producto" + data.error)
                }
            }
        })
    }
</script>