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
    <title>Eliminar dades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
        }

        input[type="radio"] {
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 5px;
            font-size: 16px;
            border: 1px solid #DDD;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #FFF;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        p {
            margin-top: 20px;
        }

        a {
            color: 	#000000;
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

    if ($conn->connect_error) {
        die("Ha fallat la connexió: " . $conn->connect_error);
    }

    // Verificar si s'ha enviat el formulari de l'eliminació
    if (isset($_POST['eliminar'])) {
        $NIF = $_POST['NIF']; // NIF de l'element a eliminar

        if (isset($_POST['eliminar'])) {
            $opcio = $_POST['opcio'];
            if ($opcio == '1') {
                $client = 'empresa';
            } else if ($opcio == '2') {
                $client = 'particular';
            }
        }

        // Construir la consulta per eliminar l'element de la base de dades
        $sql = "DELETE FROM $client WHERE NIF = '$NIF'";

        // Executar la consulta
        if (mysqli_query($conn, $sql)) {
            echo "L'element ha estat eliminat correctament.";
        } else {
            echo "Error en l'eliminació de l'element: " . mysqli_error($conn);
        }
    }

    // Tancar la connexió
    mysqli_close($conn);
    ?>

    <h1>Eliminar dades</h1>
    <form method="post" action="eliminardades.php">
        <p>Selecciona el tipus de client:</p>
        <input type="radio" name="opcio" value="1" id="empresa">
        <label for="empresa">Empresa</label><br>
        <input type="radio" name="opcio" value="2" id="particular">
        <label for="particular">Particular</label><br><br>
        <label for="NIF">NIF del client a eliminar:</label><br>
        <input type="text" name="NIF" id="NIF" placeholder="NIF del client">
        <input type="submit" name="eliminar" value="Eliminar">
    </form>
    <p><a href="queferadministrar.php">Tornar enrere</a></p>
</body>
</html>
