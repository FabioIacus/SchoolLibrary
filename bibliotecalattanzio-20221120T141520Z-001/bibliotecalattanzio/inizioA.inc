<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="Icona.ico">
	</head>
	<body>
		<ul>
			<li><a href="index.php"><img src="baseline_home_white_18dp.png"></a></li>
			<li><a href="elencolibri.php">Libri</a></li>
			<li><a href="ricerca.php">Ricerca</a></li>
			<li><a href="elencoautori.php">Autori</a></li>
			<li><a href="elencoeditori.php">Editori</a></li>
			<li><a href="gestioneprestiti.php">Prestiti</a></li>
			<li><a href="gestioneutenti.php">Utenti</a></li>
			<?php
			if ($_SESSION["nistituto"] == "Di Vittorio - Lattanzio") {
				echo "<li><a href='istituti.php'>Istituti</a></li>";
			}
			?>
			<?php include "statoutenteA.inc" ?>
		</ul>
