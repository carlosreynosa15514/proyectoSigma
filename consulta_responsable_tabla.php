<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/consulta_responsable_tabla.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>BIsqueda Responsable Cartera</title>
</head>

<body>
    <header>
        <h1> BUsqueda Responsable Cartera por Nombre </h1>
    </header>
    <nav class="menu">
        <a href="consultas.html">Home</a>
    </nav>

    <main>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form-group">
                <label for="name" id="sku">Nombre Responsable </label>
                <input type="text" name="sku" id="sku" autofocus minlength = "2">
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
                    // $cproducto = (
                    //     "SELECT * from responsable
                    //          where denominacion like $csku"
                    // );
                    $cproducto = (
                        "SELECT 
                            responsable.soc, 
                            responsable.resp, 
                            responsable.denominacion,
                            sociedades.nombre
                        FROM responsable
                            inner join sociedades
                            on responsable.soc = sociedades.sociedad
                        WHERE responsable.denominacion like $csku"
                    );
                    $contador = (
                        "SELECT count(responsable.soc) as numero from responsable
                            where responsable.denominacion like $csku"
                    );

                    // Cuento e imprimo los registros de la seleccion
                    $cuenta = $db->prepare($contador);
                    $cuenta->execute();
                    while ($pt = $cuenta->fetch())
                    {
                        echo "
                            <br>
                            <p class = 'clave'>
                                Cantidad de Registros: {$pt['numero']}
                                <br>
                            </p>";
                    };

                    // Ejecuta la seleccion princial
                    $query = $db->prepare($cproducto);
                    $query->execute();
                    echo "
                            <table class = 'table' id='tabla'>
                            <thead class = 'thead-light'>
                                <tr>
                                    <th> Sociedad </th>
                                    <th> Nombre Sociedad </th>
                                    <th> Clave Responsable </th>
                                    <th> Descripcion </th>
                                    
                                </tr>
                            </thead>";

                    while ($pt = $query->fetch())
                    {
                        echo "<tr>
                                <td> {$pt['soc']} </td>
                                <td> {$pt['nombre']} </td>
                                <td> {$pt['resp']} </td>
                                <td> {$pt['denominacion']} </td>
                                
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

