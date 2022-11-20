<?php
include 'inizio.inc';
$libro=$_GET["libro"];
$titolo=$_GET["titolo"];
?>
<html>
    <head>
        <title>Inserimento Recensione</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
	<section>
		<article>
      <p>
      <a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
      </p>
        <h3>Inserimento recensione</h3>
        <form action="esegui.php?azione=AGGIUNGI_REC&libro=<?php echo $libro ?>&titolo=<?php echo $titolo ?>" method="POST">
			<p>Inserisci testo:</p>
        <textarea style="resize:none" name="testo" rows="4" maxlength="1000" cols="50" placeholder="Inserisci qui la tua recensione..."></textarea>
      <p>Inserisci voto:
			<select name="voto" required>
        <option value="1" selected>1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
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
