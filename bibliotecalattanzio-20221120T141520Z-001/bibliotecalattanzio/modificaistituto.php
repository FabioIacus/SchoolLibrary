<?php
include 'inizio.inc';
?>
<html>
<head>
<title>Modifica Istituto</title>
<link href="style.css" rel="stylesheet" type="text/css">  </head>

<body>
<section>
<article>
	<p>
	<a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
	</p>
<p><h1>Modifica istituto</h1></p>
<?php
$id = $_GET["id"];
?>
    <form action="istituti.php?azione=MI&codice=<?php echo $id ?>" method ="POST">
   <?php
        $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
		$query="SELECT * FROM istituto where istituto.id = '$id'";
        $risultato=mysqli_query($conn,$query);
        $row = mysqli_fetch_array($risultato);
		echo "<tr>";
        echo "<td>" ."Codice meccanografico: <input type=text name='codicenuovo' value='$row[id]' required autofocus> </td>";
        echo "</tr> <br>  <br>";
        echo "<tr>";
            echo "<td>" ."Nome: <input type=text name='nome' value='$row[nome]' required autofocus> </td>";
            echo "</tr> <br>  <br>";
            echo "<tr>";
                echo "<td>" ."Selezione tipologia istituto:";?>
                <select name="tipologia" required autofocus>
                <option value="Elementari">Elementari</option>
                <option value="Superiori 1° ciclo">Superiori 1° ciclo</option>
                <option value="Superiori 2° ciclo">Superiori 2° ciclo</option>
              </select>
            </td><?php
                echo "</tr> <br>  <br>";
                echo "<tr>";
                    echo "<td>" ."Studenti iscritti: <input type=text name='studenti' value='$row[studenti_iscritti]' maxlength='6' onkeypress='onlyNumbers(event)' required autofocus> </td>";
                    echo "</tr> <br>  <br>";
                    echo "<tr>";
                        echo "<td>" ."Codice segreto: <input type=text name='segreto' value='$row[codice]' maxlength='4' onkeypress='onlyNumbers(event)' required autofocus> </td>";
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
