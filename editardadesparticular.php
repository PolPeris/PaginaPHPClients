<?php
// Iniciem la sessió
session_start();

// Comprova si l'usuari no està autenticat i redirigeix a la pàgina de login
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar dades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F9F9F9;
            margin: 20px;
        }

        h2 {
            margin-bottom: 10px;
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

        input[type="text"],
        input[type="submit"] {
            margin-top: 5px;
            padding: 8px;
            border: 1px solid #DDD;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #FFF;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            color: #000000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empreses_gegzy";

$conn = new mysqli($servername, $username, $password, $dbname);
$formulari = 1;
if ($conn->connect_error) {
    die("Ha fallat la connexió: " . $conn->connect_error);
}
if (isset($_POST["Enviar"])) {
    $formulari = 0;
    $NIF = $_POST["NIF"];
    $sql = "SELECT Localitat, NomCognom, Domicili, Telefon, Correu FROM particular WHERE NIF = '$NIF'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $Localitat = $row["Localitat"];
    $Nom = $row["NomCognom"];
    $Adreca = $row["Domicili"];
    $Telefon = $row["Telefon"];
    $Correu = $row["Correu"];
?>
    <h2>Edita les dades</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="Valornou1">Localitat:</label>
        <input type="text" name="Valornou1" id="Valornou1" value="<?php echo $Localitat; ?>"><br><br>

        <label for="Valornou2">Nom i cognom:</label>
        <input type="text" name="Valornou2" id="Valornou2" value="<?php echo $Nom; ?>"><br><br>

        <label for="Valornou3">Domicili:</label>
        <input type="text" name="Valornou3" id="Valornou3" value="<?php echo $Adreca; ?>"><br><br>

        <label for="Valornou4">Telefon:</label>
        <input type="text" name="Valornou4" id="Valornou4" value="<?php echo $Telefon; ?>"><br><br>

        <label for="Valornou5">Correu:</label>
        <input type="text" name="Valornou5" id="Valornou5" value="<?php echo $Correu; ?>"><br><br>

        <input type="hidden" name="NIF" value="<?php echo $NIF; ?>">
        <input type="submit" value="Actualitzar" name="Actualitzar">
    </form>
<?php

}
if(isset($_POST["Actualitzar"])){
    $formulari = 0;
    $NIF = $_POST["NIF"];
    $Valornou1 = $_POST["Valornou1"];
    $Valornou2 = $_POST["Valornou2"];
    $Valornou3 = $_POST["Valornou3"];
    $Valornou4 = $_POST["Valornou4"];
    $Valornou5 = $_POST["Valornou5"];
    $sql = "UPDATE particular SET Localitat = '$Valornou1', NomCognom = '$Valornou2', Domicili = '$Valornou3', Telefon = '$Valornou4', Correu = '$Valornou5' WHERE NIF = '$NIF'";

    if ($conn->query($sql) === TRUE) {
        echo "Dades actualitzades correctament.";
    } else {
        echo "Error en actualitzar les dades: " . $conn->error;
    }
}

$conn->close();
?>

<?php
if ($formulari==1){ 
?>
    <h2>Posa del client particular</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="NIF">NIF:</label>
        <input type="text" name="NIF" id="NIF"><br><br>
        <input type="submit" value="Enviar" name="Enviar">
    </form>
<?php
    }
?>

<p><a href="queferadministrar.php">Tornar enrere</a></p>
</body>
</html>