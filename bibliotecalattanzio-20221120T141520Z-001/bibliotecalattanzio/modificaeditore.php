<?php
include 'inizio.inc';
?>
<html>
<head>
<title>Modifica Editore</title>
<link href="style.css" rel="stylesheet" type="text/css">  </head>

<body>
<section>
<article>
	<p>
	<a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
	</p>
<p><h1>Modifica editore</h1></p>
<?php
$ideditore = $_GET["id"];

        $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
		$query="SELECT * FROM editori where editori.idEditore = '$ideditore' group by editori.idEditore";
        $risultato=mysqli_query($conn,$query);
        $row = mysqli_fetch_array($risultato);
		echo "<form action='esegui.php?azione=MODIFICA_EDITORE&codice=$ideditore' method=POST>";
        //echo "<tr>";
        //echo "<td>" ."Id editore: <input type=text name=id value='$row[idEditore]'> </td>&nbsp" . "&nbsp<td>";
        //echo "</tr> <br>  <br>";
		echo "<tr>";
        echo "<td>" ."Nome: <input type=text name=nome value='$row[nome]'> </td>";
        echo "</tr> <br>  <br>";
        echo "<tr>";
        echo "<td>" . "Sede: <input type=text name=sede value='$row[sede]'> </td>";
        echo "</tr> <br>  <br>";
		echo "<tr>";
        echo "<td>" . "Telefono: <input type=text name=telefono value='$row[telefono]' maxlength='14' onkeypress='onlyNumbers(event)'> </td>";
        echo "</tr>  <br>  <br>";
		echo "<tr>";
        echo "<td>" . "Anno di fondazione: <input type=text name=anno value='$row[annoFondazione]' maxlength='4' onkeypress='onlyNumbers(event)'> </td>";
        echo "</tr>  <br>  <br>";
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
