<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style_pt.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <title>Consulta PT</title>
</head>

<body>
    <header>
        <h1>Consulta de PT Sigma </h1>
    </header>
    <nav class="menu">
        <a href="consultas.html">Home</a>
    </nav>

    <main>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <label for="name" id="sku">Clave Sku </label>
            <input type="text" name="sku" id="sku" autofocus>
            <input type="submit" name="submit" class = "submit" value="Consultar">
            <a href='#' id='exportar' onclick = "tableToExcel('tabla','datos')"> Exportar a Excel </a>

            <?php
            $csku = "";
            if (isset($_POST['submit'])) {
                $csku = $_POST['sku'];
                // echo "<br><br>
                //     <p class='clave'> 
                //         Clave Sku: $csku
                //         <br>
                //     </p>";
                try {
                    $db = new PDO('sqlite:C:\Users\cmoreno\OneDrive\Cursos Practicos\Proyecto SQL\dbcatalogos.db');
                    $cproducto = $db->query(
                        "SELECT * from productos as a
                            INNER JOIN estatuspt as b
                            on a.Status = b.estatus
                         where Material = $csku"
                    );
                    echo "
                        <table class='table table-striped table-sm table-hover' id='tabla'>
                            <thead class = 'thead-light'>
                                <tr>
                                    <th class='titulos'> Concepto </th>
                                    <th class = 'titulos'> Valor </th>
                                </tr>
                            </thead> ";
                    foreach ($cproducto as $pt) {
                        echo "
                            <tr>
                                <td> Numero Sku </td>
                                <td> {$pt['Material']} </td>
                            </tr>
                            <tr>
                                <td> Descripcion del Material </td>
                                <td> {$pt['Descripcion']} </td>
                            </tr>
                            <tr>
                                <td> Dias de Vida </td>
                                <td> {$pt['dias']} </td>
                            </tr>
                            <tr>
                                <td> Kilos por Pieza </td>
                                <td> {$pt['KgPza']} </td>
                            </tr>
                            <tr>
                                <td> Kilos por Caja </td>
                                <td> {$pt['KgCaj']} </td>
                            </tr>
                            <tr>
                                <td> Kilos por Tarima </td>
                                <td> {$pt['KgPal']} </td>
                            </tr>
                            <tr>
                                <td> Piezas por Caja </td>
                                <td> {$pt['PzaCaj']} </td>
                            </tr>
                            <tr>
                                <td> Piezs por Tarima </td>
                                <td> {$pt['PzaPal']} </td>
                            </tr>
                            <tr>
                                <td> Cajas por Tarima </td>
                                <td> {$pt['CajPal']} </td>
                            </tr>
                            <tr>
                                <td> Status Red Logistica </td>
                                <td> {$pt['StRedLog']} </td>
                            </tr>
                            <tr>
                                <td> Status de Producto </td>
                                <td> {$pt['Status']} </td>
                            </tr>
                            <tr>
                                <td> Linea Red Distribucion </td>
                                <td> {$pt['LineaRed']} </td>
                            </tr>
                            <tr>
                                <td> Linea Produccion </td>
                                <td> {$pt['LineaProd']} </td>
                            </tr>
                            <tr>
                                <td> Famnilia BIW </td>
                                <td> {$pt['FamiliaBIW']} </td>
                            </tr>
                            <tr>
                                <td> Marca </td>
                                <td> {$pt['Marca']} </td>
                            </tr>
                            <tr>
                                <td> Unidad Medida Pedido </td>
                                <td> {$pt['UMdepedido']} </td>
                            </tr>
                            <tr>
                                <td> Grupo Material de Emabalaje </td>
                                <td> {$pt['GrupomatME']} </td>
                            </tr>
                            <tr>
                                <td> Denominacion Material Emabalake </td>
                                <td> {$pt['Denominacion']} </td>
                            </tr>
                            <tr>
                                <td> Grupo MAEProd </td>
                                <td> {$pt['MAEprop']} </td>
                            </tr>
                            ";
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
            ?>
        </form>
    </main>
    <script src="/js/export_excel.js"></script>
</body>

</html>