<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Ricerca</title>
        <style>
		.column {
			float:left;
			text-align:center;
			width: 50%;
		}
    img.rounded {
			border-radius: 50%;
			max-width: 100%
		}
		.row:after {
			content: "";
			display: table;
			clear: both;
		}
		@media screen and (max-width:600px) {
			.column {
				width: 100%;
			}
		.cella {
            border:1px black solid;
            padding: 5px;
        }
        table {
            border-collapse: collapse;
            overflow: scroll;
        }
		}
        </style>
    </head>
    <body>
		<?php
        if(isset($_GET["verifica"]))
		{
				if ($_GET["verifica"]=="lib")
				{
					$trovato=false;
					$conn=mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
					$sql="
					select libri.codice, libri.titolo, libri.editore, libri.annopubblic, editori.nome, GROUP_CONCAT(autori.nome) as aut
					from libri, autori, scrittura, editori, immagazzinare, istituto
					where libri.editore = editori.ideditore and libri.codice = scrittura.libro and autori.idautore = scrittura.autore and libri.titolo like '%" . addslashes($_POST['titolo']) . "%' and libri.codice = immagazzinare.libro and istituto.id = immagazzinare.istituto and immagazzinare.istituto = '" . $_SESSION["istituto"] . "'
					group by libri.codice
					";
					$risultato=mysqli_query($conn,$sql);
					$trovati = mysqli_num_rows($risultato);
					if ($trovati > 0) {
						$trovato = true;
					}
				}

				if ($_GET["verifica"]=="aut")
				{
					$trovato2=false;
					$conn=mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
					$sql="select libri.codice, libri.titolo, autori.nome, GROUP_CONCAT(libri.titolo) as aut
					from autori, scrittura, libri, immagazzinare, istituto
					where libri.codice = scrittura.libro and autori.idautore = scrittura.autore and autori.nome like '%" . addslashes($_POST['autore']) . "%' and libri.codice = immagazzinare.libro and istituto.id = immagazzinare.istituto and immagazzinare.istituto = '" . $_SESSION["istituto"] . "'
					group by autori.nome
					";
					$risultato=mysqli_query($conn,$sql);
					$trovati = mysqli_num_rows($risultato);
					if ($trovati > 0) {
						$trovato2 = true;
					}
				}
		}
?>
		<section>
		<article>

		<h2 align="center">Ricerca</h2>
		<div class="row">

		<div class="column">
		<form action="ricerca.php?verifica=lib" method ="POST">
		<h3>Ricerca per titolo:
		<input type="text" name="titolo" placeholder="Inserisci titolo..." required>
		<button name='esegui' type='submit' value='esegui'>Cerca</button>
		</h3>
		</form>
		<?php
			if (isset($trovato)) {
				if ($trovato == true) {
  					echo "<h3>";
            if($trovati == 1) {
              echo "Trovato ";
            } else {
              echo "Trovati ";
            }
             echo $trovati;
            if($trovati == 1) {
               echo " risultato ";
             }
            else {
              echo " risultati ";
            }
            echo "per il termine \"".stripslashes($_POST['titolo'])."\" <br> La parola cercata è contenuta nei seguenti titoli:</h3>";
						echo "<table>";
						echo "<tr><th>Codice</th><th>Titolo</th><th>Autore</th><th>Editore</th><th>Anno</th></tr>";
						while($row = mysqli_fetch_array($risultato)) {
							echo "<tr>";
							echo "<td class='cella'>$row[codice]</td>";
							echo "<td class='cella'>$row[titolo]</td>";
							echo "<td class='cella'>$row[aut]</td>";
							echo "<td class='cella'>$row[nome]</td>";
							echo "<td class='cella'>$row[annopubblic]</td>";
							echo "</tr>";
				}
				echo "</table>";
				mysqli_close($conn);
				}
				else {
					echo "<h3>Il termine cercato \"" . stripslashes($_POST['titolo']) . "\" non è contenuto in nessun titolo.</h3>";
				}
			}
		?>
		</div>
		<div class="column">
		<form action="ricerca.php?verifica=aut" method ="POST">
		<h3>Ricerca per autore:
		<input type="text" name="autore" placeholder="Inserisci autore..." required>
		<button name='esegui' type='submit' value='esegui'>Cerca</button>
		</h3>
		</form>
		<?php
			if (isset($trovato2)) {
				if ($trovato2 == true) {
					echo "<h3>";
          if($trovati == 1) {
            echo "Trovato ";
          } else {
            echo "Trovati ";
          }
           echo $trovati;
          if($trovati == 1) {
             echo " risultato ";
           }
          else {
            echo " risultati ";
          }
          echo "per il termine \"".stripslashes($_POST['autore'])."\" <br> La parola cercata è contenuta nei seguenti autori:</h3>";
					echo "<table>";
					echo "<tr><th>Nome</th><th>Libri scritti</th>";
					while($row = mysqli_fetch_array($risultato)) {
							echo "<tr>";
							echo "<td class='cella'>$row[nome]</td>";
							echo "<td class='cella'>$row[aut]</td>";
							echo "</tr>";
					}
					echo "</table>";
					mysqli_close($conn);
				}
				else {
					echo "<h3>Il termine cercato \"" . stripslashes($_POST['autore']) . "\" non è contenuto in nessun autore.</h3>";
				}
			}
		?>
		</div>

		</div>
		</article>
    <aside>
    <table><caption>La biblioteca</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php/biblioteca.html" target="_blank"><img class="rounded"src="https://www.divittoriolattanzio.it/home/images/biblioteca.jpg" width="100%" height="85px"></a></td></tr></table>
<br>
    <table><caption>L'istituto</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php" target="_blank"><img src="https://www.divittoriolattanzio.it/home/images/logo-scuola.png" width="100%" height="85px"></a></td></tr></table>
		</section>
    <footer>
      Made by Fabio Iacus © 2020
   </footer>
    </body>
</html>
