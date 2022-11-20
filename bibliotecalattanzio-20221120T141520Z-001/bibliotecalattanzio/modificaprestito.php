<?php
$idUtente = $_GET["idUtente"];
$codice = $_GET["codice"];
$datainizio = $_GET["DataPrestito"];
$datafine = $_GET["DataRestituzione"];
include 'inizio.inc';
?>
<html>
<head>
<title>Modifica Prestito</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<section>
<article>
	<p>
	<a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
	</p>
<h1>Modifica prestito</h1>
<!--LA QUERY DA FARE-->
<form action="esegui.php?azione=MODIFICA_PRESTITO&id=<?php echo $idUtente?>&libro=<?php echo $codice?>&data1=<?php echo $datainizio?>&data2=<?php echo $datafine?>" method="POST">
<?php
	$conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
	//libro
	echo"<p>";
	echo "Libro: ";
	$query="SELECT * from libri";
	$risultato=mysqli_query($conn,$query);
	if (mysqli_num_rows($risultato) != 0) {
		echo "<select name=codice selected>";
        $query2 = "SELECT  codice, titolo FROM libri WHERE libri.codice = '$codice'";
        $risultato2= mysqli_fetch_array(mysqli_query($conn,$query2));
        $titolo = $risultato2['titolo'];
        $codice1 = $risultato2['codice'];
		echo "<option value='$codice1'>$titolo</option>";
        while ($riga=mysqli_fetch_array($risultato)) {
			if ($risultato2['codice'] != $riga['codice']){
				echo "<option value='$riga[codice]'> $riga[titolo]</option>";
			}
        }
        echo "</select>";
    }
    echo "</p>";
	//data inizio prestito
    $query="SELECT DataPrestito FROM prestiti WHERE Utente = '$idUtente' AND Libro = '$codice' AND DataPrestito = '$datainizio' AND DataRestituzione = '$datafine' ";
    $risultato=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($risultato);
    echo "<p>";
	echo "<label for='date'>Data inizio:</label>&nbsp";
    echo "<input type='date' id='datainizio' name=datainizio value=$row[DataPrestito]>";
	echo "</p>";
	//data fine prestito
    $query="SELECT DataRestituzione FROM prestiti WHERE Utente = '$idUtente' AND Libro = '$codice' AND DataPrestito = '$datainizio' AND DataRestituzione = '$datafine' ";
    $risultato=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($risultato);
	echo "<p>";
    echo"<label for='date'>Data restituzione:</label>&nbsp";
    echo"<input type='date' id='dataRestituzione' name='datafine' value=$row[DataRestituzione]>";
	echo "</p>";
	//utente
    echo "<p>";
	echo "Utente: ";
    $query="SELECT * from utenti where IDUtente = '$idUtente'";
    $risultato=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($risultato);
	$query = "SELECT * FROM utenti";
	$risultato2 = mysqli_query($conn,$query);
	if (mysqli_num_rows($risultato2) != 0) {
		echo "<select name='id1' selected>";
		$cognome = $row['Cognome'];
        $nome = $row['Nome'];
        $codice1 = $row['IDUtente'];
		echo "<option value='$codice1'>$nome $cognome</option>";
        while ($riga=mysqli_fetch_array($risultato2)) {
			if ($codice1 != $riga['IDUtente']){
				echo "<option value='$riga[IDUtente]'>$riga[Nome] $riga[Cognome]</option>";
			}
        }
        echo "</select>";
    }
    echo "</p>";
echo "<tr>";
echo "<button name='indietro' type='submit' class= 'indietro' value='Indietro'>Modifica</button>";
echo"</form>";
echo "</tr>";






       ?>
</form>
</article>
<aside>
	<table><caption>La biblioteca</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php/biblioteca.html" target="_blank"><img class="rounded"src="https://www.divittoriolattanzio.it/home/images/biblioteca.jpg" width="100%" height="85px"></a></td></tr></table>
	<br>
	<table><caption>L'istituto</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php" target="_blank"><img src="https://www.divittoriolattanzio.it/home/images/logo-scuola.png" width="100%" height="85px"></a></td></tr></table>
</aside>
</section>
<footer>
	Made by Fabio Iacus © 2020
</footer>
</body>
</html>
