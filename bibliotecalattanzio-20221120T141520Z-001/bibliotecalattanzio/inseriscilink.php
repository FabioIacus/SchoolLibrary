<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Inserimento Link</title>
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
        <h1>Inserimento link</h1>
			<p>
                <form action="esegui.php?azione=AGGIUNGI_LINK" method="POST">
			<!--	<p>
                Inserisci il codice identificativo:
				<input type="number" name="id" min="1" max="2147483647" required autofocus>
      </p>-->
                <p>
				Inserisci link:
				<input type="text" name="link" required autofocus>
				</p>
				<p>
				Inserisci una breve descrizione:
                <input type="text" name="descrizione" required autofocus>
				</p>
				<p>
				Inserisci anno corrente:
                <input type="text" name="anno" maxlength="4" onkeypress="onlyNumbers(event)" required autofocus>
				</p>
				<p>
				<input type="submit" value="Inserisci">
				</p>
			</form>
			</p>
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
