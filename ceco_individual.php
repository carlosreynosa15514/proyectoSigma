<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/ceco_individual.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Consulta Centro de Costo</title>
</head>

<body>
    <header>
        <h1> Cecos Centro de Costo </h1>
    </header>
    <nav class="menu">
        <a href="consultas.html">Home</a>
    </nav>

    <main>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form-group">
                <label for="name" id="sku">Clave Ceco</label>
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

                try {
                    $db = new PDO('sqlite:C:\Users\cmoreno\OneDrive\Cursos Practicos\Proyecto SQL\dbcatalogos.db') or die("error de conn");
                    $cproducto = (
                        "SELECT * from cecos
                             where ceco = $csku"
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
                                    <th> Ceco </th>
                                    <th> Descripcion Ceco </th>
                                    <th> Responsable </th>
                                    <th> Departamento </th>
                                    <th> Clase </th>
                                    <th> Jerarquia </th>
                                    <th> Sociedad </th>
                                    <th> Centro Beneficio </th>
                                </tr>
                            </thead>";

                    while ($pt = $query->fetch())
                    {
                        echo "<tr>
                                <td> {$pt['ceco']} </td>
                                <td> {$pt['descripcion']} </td>
                                <td> {$pt['responsable']} </td>
                                <td> {$pt['departamento']} </td>
                                <td> {$pt['clase']} </td>
                                <td> {$pt['jerarquia']} </td>
                                <td> {$pt['sociedad']} </td>
                                <td> {$pt['cebe']} </td>
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
</body>

</html>