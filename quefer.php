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
    <title>Escull una opcio</title>
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

        input[type="radio"] {
            margin-bottom: 10px;
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

        .logout-link {
            margin-top: 20px;
        }

        .logout-link a {
            color: #333;
            text-decoration: none;
        }

        .logout-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Escull una opcio:</h1>
    <form method="POST" action="processar.php">
        <input type="radio" name="opcio" value="1"> Administrar<br>
        <input type="radio" name="opcio" value="2"> Crear client<br>
        <input type="submit" name="submit" value="Anar">
    </form>
    <div class="logout-link">
        <p><a href="logout.php">Tancar sessió</a></p>
    </div>
</body>
</html>
