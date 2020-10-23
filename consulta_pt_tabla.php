<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/consulta_pt_tabla.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Consulta PT Tabla</title>
</head>

<body>
    <header>
        <h1>Busqueda de PT por Descripcion </h1>
    </header>
    <nav class="menu">
        <a href="consultas.html">Home</a>
    </nav>

    <main>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form-group">
                <label for="name" id="sku">Descripcion </label>
                <input type="text" name="sku" id="sku" autofocus minlength = "3">
                <input type="submit" name="submit" class = "submit" value="Consultar">
            </div>

            <?php
            $csku = "";
            if (isset($_POST['submit'])) {
                $csku = $_POST['sku'];
                $csku = "'%".$csku."%'";
                
                echo "<br><br>
                    <p class='clave'> 
                        Busqueda: $csku
                        <br>
                    </p>";

                try {
                    $db = new PDO('sqlite:C:\Users\cmoreno\OneDrive\Cursos Practicos\Proyecto SQL\dbcatalogos.db') or die("error de conn");
                    $cproducto = (
                        "SELECT * from productos
                             where Descripcion like $csku"
                    );
                    $query = $db->prepare($cproducto);
                    $query->execute();
                    echo "<table class = 'table'>
                            <thead class = 'thead-light'>
                                <tr>
                                    <th> Clave </th>
                                    <th> Descripcion </th>
                                    <th> St Red Log </th>
                                    <th> Estatus </th>
                                    <th> Kilos/Pza </th>
                                    <th> Kilos/Caja </th>
                                    <th> Pzas/Caja </th>
                                </tr>
                            </thead>";

                    while ($pt = $query->fetch())
                    {
                        echo "<tr>
                                <td> {$pt['Material']} </td>
                                <td> {$pt['Descripcion']} </td>
                                <td> {$pt['StRedLog']} </td>
                                <td> {$pt['Status']} </td>
                                <td> {$pt['KgPza']} </td>
                                <td> {$pt['KgCaj']} </td>
                                <td> {$pt['PzaCaj']} </td>
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