<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style_pt.css">
    <title>Consulta PT</title>
</head>

<body>
    <header>
        <h1>Consulta de PT Sigma </h1>
    </header>

    <main>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <input type="text" name="sku" value="0" placeholder="Numero Sku">
            <input type="submit" name="submit">

            <?php
            $csku = "";
            if (isset($_POST['submit'])) {
                $csku = $_POST['sku'];
                echo "<br><br>
                    <p> 
                        Clave Sku: $csku
                        <br>
                    </p>";
                try {
                    $db = new PDO('sqlite:C:\Users\cmoreno\OneDrive\Cursos Practicos\Proyecto Python\CatalogosTk\catalogos.db');
                    $cproducto = $db->query(
                        "SELECT * from productos where Material = $csku"
                    );
                    foreach ($cproducto as $pt) {
                        echo "<p> Nombre: {$pt['Descripcion']} </p>";
                        echo "<p> Dias de Vida: {$pt['dias']} </p>";                        
                        echo "<p> Kilos por Pieza: {$pt['KgPza']} </p>";
                        echo "<p> Kilos por Caja: {$pt['KgCaj']} </p>";
                        echo "<p> Kilos por Pallet: {$pt['KgPal']} </p>";
                        echo "<p> Piezas por Caja: {$pt['PzaCaj']} </p>";
                        echo "<p> Piezas por Pallet: {$pt['PzaPal']} </p>";
                        echo "<p> Cajas por Pallet: {$pt['CajPal']} </p>";
                        echo "<p> Estatus Reg Logistica: {$pt['StRedLog']} </p>";
                        echo "<p> Status: {$pt['Status']} </p>";                        
                        echo "<p> Linea Red: {$pt['LineaRed']} </p>";
                        echo "<p> Linea Produccion: {$pt['LineaProd']} </p>";
                        echo "<p> Familia BIW: {$pt['FamiliaBIW']} </p>";
                        echo "<p> Familia: {$pt['Familia']} </p>";
                        echo "<p> Linea Comercial: {$pt['LineaCom']} </p>";
                        echo "<p> Linea BIW: {$pt['LineaBIW']} </p>";
                        echo "<p> Marca: {$pt['Marca']} </p>";
                        echo "<p> Unidad de Pedido: {$pt['UMdepedido']} </p>";
                        echo "<p> Grupo Material Embalaje: {$pt['GrupomatME']} </p>";
                        echo "<p> Denominacion de Maerial Embalaje: {$pt['Denominacion']} </p>";
                        echo "<p> MAEprop: {$pt['MAEprop']} </p>";
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
            ?>
        </form>
    </main>
</body>

</html>