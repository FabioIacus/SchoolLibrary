<?php
include 'inizio.inc';
?>
<html>
<head>
<title>Modifica Autore</title>
<link href="style.css" rel="stylesheet" type="text/css">  </head>

<body>
<section>
<article>
	<p>
	<a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
	</p>
<p><h1>Modifica autore</h1></p>
<?php
$idAutore = $_GET["idAutore"];
?>
    <form action="esegui.php?azione=MODIFICA_AUTORE&codice=<?php echo $idAutore ?>" method ="POST">
   <?php
        $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
		$query="SELECT autori.idAutore, autori.Nome FROM autori where autori.idAutore = '$idAutore' group by autori.idAutore";
        $risultato=mysqli_query($conn,$query);
        $row = mysqli_fetch_array($risultato);
		echo "<tr>";
        echo "<td>" ."Nome: <input type=text name=nome value='$row[Nome]'> </td>";
        echo "</tr> <br>  <br>";
		echo "<tr>";
        echo "<button name='esegui' type='submit' value='esegui'>Modifica</button>";
        echo"</form>";
        echo "</tr>";
	?>
	<script type="text/javascript">
function onlyNumbers(evt) {
var theEvent = evt || window.event;
var key = theEvent.keyCode || theEvent.which;
key = String.fromCharCode( key );
var regex = /[0-9]/;
if( !regex.test(key) ) {
theEvent.returnValue = false;
if(theEvent.preventDefault) theEvent.preventDefault();
}
}
</script>
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
