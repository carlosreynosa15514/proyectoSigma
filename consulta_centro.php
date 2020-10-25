<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/consulta_centro.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Consulta Centro</title>
</head>

<body>
    <header>
        <h1> Consulta Centro - Sucursal </h1>
    </header>
    <nav class="menu">
        <a href="consultas.html">Home</a>
    </nav>

    <main>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form-group">
                <label for="name" id="sku">Clave Centro</label>
                <input type="text" name="sku" id="sku" autofocus minlength = "3">
                <input type="submit" name="submit" class = "submit" value="Consultar">
            </div>

            <?php
                $csku = "";
                if (isset($_POST['submit'])) {
                    $csku = $_POST['sku'];
                    //$csku = "'%".$csku."%'";
                    
                    // echo "<br><br>
                    //     <p class='clave'> 
                    //         Busqueda: $csku
                    //         <br>
                    //     </p>";

                    // Aseguramos que el campo centro no se capture VACIO
                    if ($csku)
                    { 
                        try {
                            $db = new PDO('sqlite:C:\Users\cmoreno\OneDrive\Cursos Practicos\Proyecto SQL\dbcatalogos.db') or die("error de conn");
                            $cproducto = (
                                "SELECT * from centros
                                    where centro = $csku"
                            );
                            // $contador = (
                            //     "SELECT count(ceco) as numero from cecos
                            //         where responsable like $csku"
                            // );

                            // // Cuento e imprimo los registros de la seleccion
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
                            echo "<table class = 'table'>
                                    <thead class = 'thead-light'>
                                        <tr>
                                            <th> Centro </th>
                                            <th> Nombre Centro</th>
                                            <th> Sociedad </th>
                                            <th> Nombre Sociedad </th>
                                        </tr>
                                    </thead>";

                            while ($pt = $query->fetch())
                            {
                                echo "<tr>
                                        <td> {$pt['centro']} </td>
                                        <td> {$pt['site']} </td>
                                        <td> {$pt['soc']} </td>
                                        <td> {$pt['sociedad']} </td>
                                    </tr>";
                            }
                        }catch (PDOException $e) {
                            echo $e->getMessage();
                        }
                        echo "</table>";
                    }else{
                    echo "El campo no puede estar vacio";
                    }
                }
            ?>
        </form>
    </main>
</body>

</html>