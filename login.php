<?php
// Iniciem la sessió
session_start();

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "empreses_gegzy";

$conn = new mysqli($servername, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Ha fallat la connexió: " . $conn->connect_error);
}

// Comprova si l'usuari ja està autenticat i redirigeix a la pàgina "quefer.php"
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header("Location: quefer.php");
    exit();
}

// Comprova si s'ha enviat el formulari de login
if (isset($_POST['submit'])) {
    // Obtenir les credencials introduïdes per l'usuari
    $user = $_POST['user'];
    $password = $_POST['password'];

    // Consulta a la base de dades per comprovar les credencials
    $stmt = $conn->prepare("SELECT * FROM usuaris WHERE user = ? LIMIT 1");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprova si s'ha retornat algun resultat
    if ($result->num_rows > 0) {
        // Obté les dades de l'usuari
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Comprova si la contrasenya és correcta
        if ($password === $storedPassword) {
            // L'usuari s'ha autenticat amb èxit
            $_SESSION['authenticated'] = true;
            header("Location: quefer.php");
            exit();
        } else {
            // Contrasenya incorrecta
            echo "Contrasenya incorrecta!";
        }
    } else {
        // L'usuari no existeix
        echo "L'usuari no existeix!";
    }

    // Allibera la memòria de la consulta
    $result->free();
}

// Tanca la connexió a la base de dades
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 0px 0px 15px 0px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            margin: 10px 10px 0px 0px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;  
        }

        .error {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Inici de sessió</h2>
    <form method="POST" action="login.php">
        <label for="user">Nom d'usuari:</label>
        <input type="text" id="user" name="user" required>
        <br>
        <label for="password">Contrasenya:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="submit" value="Iniciar sessió">
        <?php
        if (isset($_POST['submit']) && isset($errorMessage)) {
            echo '<div class="error">' . $errorMessage . '</div>';
        }
        ?>
    </form>
</body>
</html>
