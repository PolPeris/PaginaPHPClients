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
if (isset($_POST['submit'])) {
	$opcio = $_POST['opcio'];
	if ($opcio == '1') {
		header('Location: queferadministrar.php');
		exit;
	} else if ($opcio == '2') {
		header('Location: crear.php');
		exit;
	}
}
?>