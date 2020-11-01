<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/cuenta_contable.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Consulta Cuenta Contable</title>
</head>

<body>
    <header>
        <h1> Consulta Cuenta Contable Gastos </h1>
    </header>
    <nav class="menu">
        <a href="consultas.html">Home</a>
    </nav>

    <main>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form-group">
                <label for="name" id="sku">Cuenta de Gastos</label>
                <input type="text" name="sku" id="sku" autofocus minlength = "3">
                <input type="submit" name="submit" class = "submit" value="Consultar">
                <a href='#' id='exportar' onclick = "tableToExcel('tabla','datos')"> Exportar a Excel </a>
            </div>

            <?php
            $csku = "";
            if (isset($_POST['submit'])) {
                $csku = $_POST['sku'];
                // $csku = "'%".$csku."%'";
                
                // echo "<br><br>
                //     <p class='clave'> 
                //         Busqueda: $csku
                //         <br>
                //     </p>";

                if($csku) {

                    try {
                        $db = new PDO('sqlite:C:\Users\cmoreno\OneDrive\Cursos Practicos\Proyecto SQL\dbcatalogos.db') or die("error de conn");
                        $cproducto = (
                            "SELECT * from sigsiere
                                where cuenta = $csku"
                        );

                        // SE COMENTO ESTE BLOQUE PORQUE ES CONSULTA INDIVIDUAL
                        // $contador = (
                        //     "SELECT count(cuenta) as numero from sigsiere
                        //         where nivel3 like $csku"
                        // );

                        // Cuento e imprimo los registros de la seleccion
                        // $cuenta = $db->prepare($contador);
                        // $cuenta->execute();
                        // while ($pt = $cuenta->fetch())
                        // {
                        //     echo "
                        //         <br>
                        //         <p class = 'clave'>
                        //             Cantidad de Registros: {$pt['numero']}
                        //             <br>
                        //         </p>";
                        // };

                        // Ejecuta la seleccion princial
                        $query = $db->prepare($cproducto);
                        $query->execute();
                        echo "<table class = 'table'  id = 'tabla'>
                                <thead class = 'thead-light'>
                                    <tr>
                                        <th> Cuenta </th>
                                        <th> Nivel 3 Sigsiere </th>
                                        <th> Nombre de la Cuenta </th>
                                    </tr>
                                </thead>";

                        while ($pt = $query->fetch())
                        {
                            echo "<tr>
                                    <td> {$pt['cuenta']} </td>
                                    <td> {$pt['nivel3']} </td>
                                    <td> {$pt['descripcion']} </td>
                                </tr>";
                        };
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                    echo "</table>";
                }
                else {
                    echo "Numero de cuenta vacío, intenta de nuevo";
                }
            }
            ?>
        </form>
    </main>
    <script src="/js/export_excel.js"></script>
</body>
</html>