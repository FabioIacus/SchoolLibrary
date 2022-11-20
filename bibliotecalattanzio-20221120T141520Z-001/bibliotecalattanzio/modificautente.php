<?php
include 'inizio.inc';
?>
<html>
<head>
<title>Modifica Utente</title>
<link href="style.css" rel="stylesheet" type="text/css">  </head>
<body>
<section>
<article>
  <p>
  <a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
  </p>
  <h1>Modifica utente</h1></p>
<?php
$idUtente = $_GET["idutente"];
?>
    <form action="gestioneutenti.php?azione=MU&idUtente=<?php echo$idUtente ?>" method ="POST">
	<?php
    //Apre connessione al server
    $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
	$query="SELECT * FROM utenti, ruoli where utenti.IDUtente = '$idUtente' and utenti.idruolo = ruoli.idruolo";
    $risultato=mysqli_query($conn,$query);
    $row = mysqli_fetch_array($risultato);
	echo "<p>";
    echo "Cognome: <input type=text name=cognome value='$row[Cognome]'>";
    echo "</p>";
    echo "<p>";
    echo "<p>";
    echo "Nome: <input type=text name=nome value='$row[Nome]'>";
    echo "</p>";
	echo "<p>";
    echo "Username: <input type=text name=username value='$row[Username]'>";
    echo "</p>";
	echo "<p>";
	echo "Telefono: <input type=text name=telefono value='$row[Telefono]'>";
	echo "</p>";
	echo "<p>";
    echo "Password:<input type=text name=password value='$row[PW]'>";
    echo "</p>";
    echo "<p>";
	echo "Ruolo:";
	$query = "SELECT * from ruoli order by idruolo";
    $risultato = mysqli_query($conn, $query);
    if(mysqli_num_rows($risultato) != 0){
		echo "<select name='ruolo' selected>";
		$ID = $row["IDRuolo"];
        $ruolo = $row["Ruolo"];
        echo "<option value='$ID'>$ruolo</option>";
        while($riga=mysqli_fetch_array($risultato)) {
            if($ID != $riga['IDRuolo']){
                echo "<option value='$riga[IDRuolo]'>$riga[Ruolo]</option>";
            }
        }
        echo "</select>";
    }
	echo "</p>";
    echo "<button name='esegui' type='submit' class= 'indietro' value='esegui'>Modifica</button>";
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
