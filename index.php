<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <form id="productoForm">
        <h1>Formulario de Producto</h1>

        <div class="form-row">
            <div class="form-group">
                <label>Código:</label>
                <input type="text" id="codigo">
            </div>
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" id="nombre">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Bodega:</label>
                <select id="bodega"></select>
            </div>
            <div class="form-group">
                <label>Sucursal:</label>
                <select id="sucursal"></select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Moneda:</label>
                <select id="moneda">
                    <option value=""></option>
                    <option value="DÓLAR">DÓLAR</option>
                    <option value="EURO">EURO</option>
                    <option value="PESO">PESO</option>
                </select>

            </div>
            <div class="form-group">
                <label>Precio:</label>
                <input type="text" id="precio">
            </div>
        </div>

        <label style="margin-top: 8px;">Material del Producto:</label>
        <div class="material-group" style="margin-bottom: 20px; margin-top:10px;">
            <input type="checkbox" name="material" value="Plástico"> Plástico
            <input type="checkbox" name="material" value="Metal"> Metal
            <input type="checkbox" name="material" value="Madera"> Madera
            <input type="checkbox" name="material" value="Vidrio"> Vidrio
            <input type="checkbox" name="material" value="Textil"> Textil
        </div>

        <label style="margin-bottom: 3px;">Descripción:</label>
        <textarea id="descripcion"></textarea>

        <button type="submit">Guardar Producto</button>
    </form>

    <script src="js/script.js"></script>
</body>

</html>