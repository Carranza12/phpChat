<?php
$servername = "localhost";
$username = "root";
$password = "12323bueno";
$dbname = "prueba";


$conn = mysql_connect($servername, $username, $password);
if (!$conn) {
    die("Conexión fallida: " . mysql_error());
}

// Seleccionar la base de datos
$db_selected = mysql_select_db($dbname, $conn);
if (!$db_selected) {
    die ('No se pudo seleccionar la base de datos: ' . mysql_error());
}

// Si se envió el formulario de agregar
if (isset($_POST['submit'])) {
    $nombre_completo = mysql_real_escape_string($_POST['nombre_completo']);
    $correo = mysql_real_escape_string($_POST['correo']);
    $comentario = mysql_real_escape_string($_POST['comentario']);

    // Insertar nuevo registro
    $sql = "INSERT INTO usuarios (nombre_completo, correo, comentario)
            VALUES ('$nombre_completo', '$correo', '$comentario')";
    $result = mysql_query($sql);
    if (!$result) {
        die('Error al insertar registro: ' . mysql_error());
    }
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Usuarios</title>
</head>
<body>
    <h1>CRUD de Usuarios</h1>

    <h2>Agregar Usuario</h2>
    <form method="post" action="">
        <label for="nombre_completo">Nombre Completo:</label><br>
        <input type="text" id="nombre_completo" name="nombre_completo" required><br><br>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>
        <label for="comentario">Comentario:</label><br>
        <textarea id="comentario" name="comentario" required></textarea><br><br>
        <input type="submit" name="submit" value="Agregar">
    </form>

    <h2>Usuarios</h2>
    <table border="1">
        <tr>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Comentario</th>
            <th>Acción</th>
        </tr>
        <?php
        // Mostrar registros
        $sql = "SELECT * FROM usuarios";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['nombre_completo']."</td>";
            echo "<td>".$row['correo']."</td>";
            echo "<td>".$row['comentario']."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Cerrar conexión
mysql_close($conn);
?>
