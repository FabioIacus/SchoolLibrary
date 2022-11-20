<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Richiedi Prestito</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
	<section>
	<article>
        <h1>Richiedi prestito</h1>

			<p>
      <form action="esegui.php?azione=AGGIUNGI_PRESTITOU" method="POST">
      <p>
			Seleziona il libro:
								<?php
                                $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
                                $query="SELECT libri.codice, libri.titolo from libri, immagazzinare, istituto where libri.codice = immagazzinare.libro and istituto.id = immagazzinare.istituto and immagazzinare.istituto = '" . $_SESSION["istituto"] . "' order by titolo";
                                $risultato=mysqli_query($conn,$query);
                                if (mysqli_num_rows($risultato) != 0)
                                {
                                    echo "<select name='libro' selected>";
                                    while ($row=mysqli_fetch_array($risultato))
                                    {
									                             echo "<option value='$row[codice]'>$row[titolo]</option>";
                                    }
                                    echo "</select>";
                                }
                                mysqli_close($conn);
                                ?>
			</p>
								<p>
								Inserisci la data di inizio prestito:
                                <input type="date" name="datap" required autofocus>
								</p>
								<p>
								Inserisci la data di fine prestito:
                                <input type="date" name="datar" required autofocus>
								</p>
								<p>
								<input type="submit" value="Richiedi">
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
