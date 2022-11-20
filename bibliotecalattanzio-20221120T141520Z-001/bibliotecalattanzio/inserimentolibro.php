<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Inserimento Libro</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
	<section>
		<article>
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
      <p>
      <a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
      </p>
        <h3>Inserimento libro</h3>
        <form action="esegui.php?azione=AGGIUNGI_LIBRI" method="POST">
			<p>Inserisci il codice identificativo:
			<input type="text" name="isbn" maxlength="13" onkeypress="onlyNumbers(event)" required autofocus>
			</p>
            <p>Inserisci il titolo:
			<input type="text" name="Titolo" required autofocus>
			</p>
			<p>Seleziona l'editore:
            <?php
				$conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
                $query="SELECT * from editori order by nome";
                $risultato=mysqli_query($conn,$query);
                if (mysqli_num_rows($risultato) != 0){
                    echo "<select name=\"idEditore\" required>";
                    while ($row=mysqli_fetch_array($risultato)) {
						echo "<option value=\"$row[idEditore]\">$row[nome]</option>";
                    }
                    echo "</select>";
                }
                mysqli_close($conn);
            ?>
			</p>
			<p>Inserisci l'anno di pubblicazione:
            <input type="text" name="anno" maxlength="4" onkeypress="onlyNumbers(event)" required autofocus>
            </p>
			<p>Seleziona l'autore:
            <br>
            <?php
                $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
                $query="SELECT * from autori";
                $risultato=mysqli_query($conn,$query);
                if (mysqli_num_rows($risultato) != 0){
                    while ($row= mysqli_fetch_array($risultato)) {
                        echo "&nbsp&nbsp&nbsp-"."$row[nome] <input type=\"checkbox\" name=\"aut[]\" value=$row[idAutore]><br>";
                    }
                }
                else {
                    echo "Non ci sono autori.";
                }
            ?>
			</p>
			<p><input type="submit" value="Inserisci"></p>
		</form>
		</article>
    <aside>
      <table><caption>La biblioteca</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php/biblioteca.html" target="_blank"><img class="rounded"src="https://www.divittoriolattanzio.it/home/images/biblioteca.jpg" width="100%" height="85px"></a></td></tr></table>
  <br>
      <table><caption>L'istituto</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php" target="_blank"><img src="https://www.divittoriolattanzio.it/home/images/logo-scuola.png" width="100%" height="85px"></a></td></tr></table></aside>
		</section>
    <footer>
      Made by Fabio Iacus © 2020
   </footer>
    </body>
</html>
