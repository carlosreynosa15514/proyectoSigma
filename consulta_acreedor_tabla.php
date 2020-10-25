<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/consulta_acreedor_tabla.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Busqueda Acreedor</title>
</head>

<body>
    <header>
        <h1> Busqueda Acreedor </h1>
    </header>
    <nav class="menu">
        <a href="consultas.html">Home</a>
    </nav>

    <main>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form-group">
                <label for="name" id="sku">Nombre Acreedor</label>
                <input type="text" name="sku" id="sku" autofocus minlength = "3">
                <input type="submit" name="submit" class = "submit" value="Consultar">
                <a href='#' id='exportar' onclick = "tableToExcel('tabla','datos')"> Exportar a Excel </a>
            </div>

            <?php
            $csku = "";
            if (isset($_POST['submit'])) {
                $csku = $_POST['sku'];
                $csku = "'%".$csku."%'";
                
                // echo "<br><br>
                //     <p class='clave'> 
                //         Busqueda: $csku
                //         <br>
                //     </p>";

                try {
                    $db = new PDO('sqlite:C:\Users\cmoreno\OneDrive\Cursos Practicos\Proyecto SQL\dbcatalogos.db') or die("error de conn");
                    $cproducto = (
                        "SELECT * from acreedores
                             where nombreproveedor like $csku"
                    );
                    $query = $db->prepare($cproducto);
                    $query->execute();
                    echo "<table class = 'table' id = 'tabla'>
                            <thead class = 'thead-light'>
                                <tr>
                                    <th> Sociedad </th>
                                    <th> Num Acreedor </th>
                                    <th> Nombre Acreedor </th>
                                    <th> Organizacion Compra </th>
                                    <th> Via Pago </th>
                                    <th> Grupo Compra</th>
                                    <th> Cond Pago FI </th>
                                    <th> Cond Pago Copmras </th>
                                </tr>
                            </thead>";

                    while ($pt = $query->fetch())
                    {
                        echo "<tr>
                                <td> {$pt['sociedad']} </td>
                                <td> {$pt['acreedor']} </td>
                                <td> {$pt['nombreproveedor']} </td>
                                <td> {$pt['orgcpra']} </td>
                                <td> {$pt['viapago']} </td>
                                <td> {$pt['gpcpra']} </td>
                                <td> {$pt['condpfi']} </td>
                                <td> {$pt['condpmm']} </td>
                              </tr>";
                    };
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                echo "</table>";
            }
            ?>
        </form>
    </main>
    <script src="/js/export_excel.js"></script>
</body>

</html>