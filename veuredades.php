<?php
// Iniciem la sessió
session_start();

// Comprova si l'usuari no està autenticat i redirigeix a la pàgina de login
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empreses_gegzy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ha fallat la connexio: " . $conn->connect_error);
}
// Obtenir dades de la taula
$sql = "SELECT * FROM empresa";
$resultat = $conn->query($sql);

// Comprobar si s'han trobat resultats
if ($resultat->num_rows > 0) {
    // Mostrar los resultats
    echo "<h2>EMPRESES:</h2>";
    echo '<table>';
    echo '<tr>
        <th>Adreça</th>
        <th>Localitat</th>
        <th>NIF</th>
        <th>Nom</th>
        <th>Telefon</th>
        <th>Correu</th>
    </tr>';
    while($fila = $resultat->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $fila["Adreca"] . '</td>';
        echo '<td>' . $fila["Localitat"] . '</td>';
        echo '<td>' . $fila["NIF"] . '</td>';
        echo '<td>' . $fila["Nom"] . '</td>';
        echo '<td>' . $fila["Telefon"] . '</td>';
        echo '<td>' . $fila["Correu"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "<p>No s'han trobat resultats</p>";
}

// Obtenir dades de la taula
$sql = "SELECT * FROM particular";
$resultat = $conn->query($sql);

// Comprobar si s'han trobat resultats
if ($resultat->num_rows > 0) {
    // Mostrar els resultats
    echo "<h2>PARTICULARS:</h2>";
    echo '<table>';
    echo '<tr>
        <th>Domicili</th>
        <th>Localitat</th>
        <th>NIF</th>
        <th>Nom i cognom</th>
        <th>Telefon</th>
        <th>Correu</th>
    </tr>';
    while($fila = $resultat->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $fila["Domicili"] . '</td>';
        echo '<td>' . $fila["Localitat"] . '</td>';
        echo '<td>' . $fila["NIF"] . '</td>';
        echo '<td>' . $fila["NomCognom"] . '</td>';
        echo '<td>' . $fila["Telefon"] . '</td>';
        echo '<td>' . $fila["Correu"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "<p>No s'han trobat resultats</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Que fer administrar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #f0f0f0;
        }

        a {
            color: #0066cc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <p><a href="queferadministrar.php">Tornar enrere</a></p>
</body>
</html>