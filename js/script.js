document.addEventListener("DOMContentLoaded", function () {
    cargarBodegas();

    document.getElementById("bodega").addEventListener("change", function () {
        cargarSucursales(this.value);
    });

    document.getElementById("codigo").addEventListener("blur", function () {
        validarCodigoUnico(this.value);
    });

    document.getElementById("productoForm").addEventListener("submit", function (event) {
        event.preventDefault();

        let codigo = document.getElementById("codigo").value.trim();
        let nombre = document.getElementById("nombre").value.trim();
        let bodega = document.getElementById("bodega").value;
        let sucursal = document.getElementById("sucursal").value;
        let moneda = document.getElementById("moneda").value;
        let precio = document.getElementById("precio").value.trim();
        let descripcion = document.getElementById("descripcion").value.trim();
        let materiales = Array.from(document.querySelectorAll("input[name='material']:checked")).map(e => e.value);

        if (!codigo) {
            alert("El código del producto no puede estar en blanco.");
            return;
        }
        if (!/^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d]{5,15}$/.test(codigo)) {
            alert("El código del producto debe contener letras y números, con una longitud de 5 a 15 caracteres.");
            return;
        }

        if (!nombre || nombre.length < 2 || nombre.length > 50) {
            alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
            return;
        }

        if (!bodega) {
            alert("Debe seleccionar una bodega.");
            return;
        }
        if (!sucursal) {
            alert("Debe seleccionar una sucursal.");
            return;
        }

        if (!moneda) {
            alert("Debe seleccionar una moneda.");
            return;
        }

        if (!precio || !/^\d+(\.\d{1,2})?$/.test(precio) || parseFloat(precio) <= 0) {
            alert("El precio del producto debe ser un número positivo con hasta dos decimales.");
            return;
        }

        if (materiales.length < 2) {
            alert("Debe seleccionar al menos dos materiales.");
            return;
        }

        if (!descripcion || descripcion.length < 10 || descripcion.length > 1000) {
            alert("La descripción del producto debe tener entre 10 y 1000 caracteres.");
            return;
        }

        let datos = { codigo, nombre, bodega, sucursal, moneda, precio, materiales, descripcion };

        fetch("php/guardar_producto.php", {
            method: "POST",
            body: JSON.stringify(datos),
            headers: { "Content-Type": "application/json" }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Producto guardado con éxito.");
                document.getElementById("productoForm").reset();
            } else {
                alert("Error: " + data.message);
            }
        });
    });
});

function cargarBodegas() {
    fetch("php/obtener_bodegas.php")
        .then(response => response.json())
        .then(data => {
            let bodegaSelect = document.getElementById("bodega");
            bodegaSelect.innerHTML = '<option value=""></option>';
            data.forEach(bodega => {
                let option = document.createElement("option");
                option.value = bodega.id;
                option.textContent = bodega.nombre;
                bodegaSelect.appendChild(option);
            });
        });
}

function cargarSucursales(bodega_id) {
    fetch("php/obtener_sucursales.php?bodega=" + bodega_id)
        .then(response => response.json())
        .then(data => {
            let sucursalSelect = document.getElementById("sucursal");
            sucursalSelect.innerHTML = '<option value=""></option>';
            data.forEach(sucursal => {
                let option = document.createElement("option");
                option.value = sucursal.id;
                option.textContent = sucursal.nombre;
                sucursalSelect.appendChild(option);
            });
        });
}

function validarCodigoUnico(codigo) {
    fetch("php/validar_codigo.php?codigo=" + codigo)
        .then(response => response.json())
        .then(data => {
            if (!data.unico) {
                alert("El código del producto ya está registrado.");
                document.getElementById("codigo").value = "";
            }
        });
}
