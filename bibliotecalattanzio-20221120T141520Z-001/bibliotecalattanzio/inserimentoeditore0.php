<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Inserimento Editore</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			.new {
				list-style-type: square;
				background-color: white;
			}
			.new-li {

			}
		</style>
    </head>
    <body>
	<section>
		<article>
      <p>
      <a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
      </p>
        <h3>Inserimento editore</h3>
        <form action="esegui.php?azione=AGGIUNGI_EDITORE" method="POST">
			<!-- <p>Inserisci il codice identificativo:
			<input type="text" name="id" required autofocus>
    </p> -->
            <p>Inserisci il nome:
			<input type="text" name="nome" required autofocus>
			</p>
			<p>Inserisci la sede:
            <input type="text" name="sede" required autofocus>
			</p>
			<p>Inserisci il numero di telefono:
            <input type="text" name="telefono" maxlength="14" onkeypress="onlyNumbers(event)" required autofocus>
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
            </p>
			<p>Inserisci l'anno di fondazione:
            <input type="text" name="anno" maxlength="4" onkeypress="onlyNumbers(event)" required autofocus>
			</p>
			<p><input type="submit" value="Inserisci"></p>
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
