<?php
// Iniciem la sessió
session_start();

// Comprova si l'usuari no està autenticat i redirigeix a la pàgina de login
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empreses_gegzy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ha fallat la connexio: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dades client empresa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: inline-block;
            width: 100px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            padding: 5px;
            width: 200px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back-link {
            margin-top: 20px;
        }

        .back-link a {
            color: #333;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Dades client empresa</h1>
    <form method="POST" action="crearclientempresa.php">
        <label for="Nom">Nom:</label>
        <input type="text" name="Nom" id="Nom"><br>
        <br/>
        <label for="NIF">NIF:</label>
        <input type="text" name="NIF" id="NIF"><br>
        <br/>
        <label for="Adreca">Adreça:</label>
        <input type="text" name="Adreca" id="Adreca"><br>
        <br/>
        <label for="Localitat">Localitat:</label>
        <input type="text" name="Localitat" id="Localitat"><br>
        <br/>
        <label for="Telefon">Telefon:</label>
        <input type="text" name="Telefon" id="Telefon"><br>
        <br/>
        <label for="Correu">Correu:</label>
        <input type="text" name="Correu" id="Correu"><br>
        <br/>
        <input type="submit" name="submit" value="Enviar dades">
    </form>
    <div class="back-link">
        <p><a href="crear.php">Tornar enrere</a></p>
    </div>
</body>
</html>

<?php

// Processar les dades del formulari si s'ha enviat el formulari
if (isset($_POST['submit'])) {
    // Recollir les dades del formulari
    $Nom = $_POST['Nom'];
    $NIF = $_POST['NIF'];
    $Adreca = $_POST['Adreca'];
    $Localitat = $_POST['Localitat'];
    $Telefon = $_POST['Telefon'];
    $Correu = $_POST['Correu'];

    // Inserir dades a la base de dades
    $sql = "INSERT INTO empresa (Nom, NIF, Adreca, Localitat, Telefon, Correu) VALUES ('$Nom', '$NIF', '$Adreca', '$Localitat', '$Telefon', '$Correu')";

    if (mysqli_query($conn, $sql)) {
        echo "Dades inserides correctament";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Tancar connexió
mysqli_close($conn);

?>