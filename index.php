<?php
$servername = "localhost";
$username = "root";
$password = "12323bueno";
$dbname = "prueba";



$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $comentario = $_POST['comentario'];

    // Insertar nuevo registro
    $sql = "INSERT INTO usuarios (nombre_completo, correo, comentario)
            VALUES ('$nombre_completo', '$correo', '$comentario')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Comentario agregado correctamente');</script>";
    } else {
        echo "Error al insertar registro: " . $conn->error;
    }
}

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>CHAT de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .chat-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow-y: scroll;
            height: 400px; /* Altura fija para mostrar el historial de mensajes */
        }

        .message {
            margin-bottom: 10px;
        }

        .message .user {
            font-weight: bold;
            color: #333;
        }

        .message .time {
            font-size: 0.8em;
            color: #777;
        }

        .message .content {
            background-color: #f1f0f0;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Chat de Usuarios</h1>

    <h2>Agregar un comentario</h2>
    <form method="post" action="">
        <label for="nombre_completo">Nombre Completo:</label><br>
        <input type="text" id="nombre_completo" name="nombre_completo" required><br><br>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>
        <label for="comentario">Comentario:</label><br>
        <textarea id="comentario" name="comentario" required></textarea><br><br>
        <input type="submit" name="submit" value="Agregar">
    </form>

    <div class="chat-container">
        <h2>Chat</h2>
        <?php

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="message">';
                echo '<span class="user">' . $row['nombre_completo'] . '</span>';
                echo '<span class="time">' . $row['correo'] . '</span>';
                echo '<p class="content">' . $row['comentario'] . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay mensajes.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
