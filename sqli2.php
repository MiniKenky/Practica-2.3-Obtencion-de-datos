<html>
<head>
    <link rel="stylesheet" type="text/css" href="table.css">
</head>

<body>
<div class="form">
    <form action="sqli2.php" method="get">
        Artículo: <input type="text" name="articulo">
        <input type="submit">
</div>
<?php
if (isset($_GET["articulo"])) {
    $conexion = mysqli_connect("localhost", "root", "", "demos")
    or die ("No se puede conectar con el servidor");

     // Consulta SQL preparada
     $queEmp = "SELECT * FROM demos.articulos WHERE Nombre = ?";
     $stmt = mysqli_prepare($conexion, $queEmp);
 
     // Asociamos los parámetros y ejecutamos la consulta
     mysqli_stmt_bind_param($stmt, 's', $_GET["articulo"]);
     mysqli_stmt_execute($stmt);
 
     // Obtenemos los resultados
     $resEmp = mysqli_stmt_get_result($stmt);
     $totEmp = mysqli_num_rows($resEmp);

    if ($totEmp > 0) {
        echo '<div  class="table">';
        echo '<table>';
        echo "<tr><th>Artículo</th><th>Precio</th></tr>";
        while ($rowEmp = mysqli_fetch_assoc($resEmp)) {
            echo "<tr><td> " . $rowEmp['Nombre'] . "</td><td> " . $rowEmp['Precio'] . "</td></tr>";
        }
        echo '</table>';
        echo '</div>';
    } else {
        echo "Artículo no encontrado. :(";
    }
        // Cerramos la consulta y conexión
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

}

?>

</form>
</form>
</body>

</html>
