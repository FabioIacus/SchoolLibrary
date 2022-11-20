<?php
include 'inizio.inc';
?>
<html>
<head>
  <title>Istituti</title>
  <meta charset="windows-1252">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  .cella {
      border:1px black solid;
      padding: 5px;
  }
  table {
      border-collapse: collapse;
  }
  article {
    text-align: center;
  }
  </style>
</head>
<body>
<section>
<article>
<?php

        if(isset($_GET["azione"]))
		{
				if ($_GET["azione"]=="EL")
				{
					$connE=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
					$sql="delete from istituto where istituto.id='$_GET[id]'";
					$ris=mysqli_query($connE,$sql);
					mysqli_close($connE);
				}
				if ($_GET["azione"]=="II")
				{
          $connE=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
          $controlla= "select istituto.codice from istituto where istituto.codice = '$_POST[segreto]'";
					$r = mysqli_query($connE,$controlla);
					if (mysqli_num_rows($r) == 0) {
            $codice =$_POST["codice"];
            $nome = addslashes($_POST["nome"]);
            $tipologia = $_POST["tipologia"];
            $studenti = $_POST["studenti"];
            $segreto= $_POST["segreto"];
            $sql="insert into istituto (id, nome, tipologia, studenti_iscritti, codice) values ('$codice','$nome','$tipologia','$studenti','$segreto')";
            $ris=mysqli_query($connE,$sql);
            echo "<b><p style='color: green; text-align:center; margin-top: 0em;'>Istituto inserito correttamente!</p></b>";
          } else {
            echo "<b><p style='color: red; text-align:center; margin-top: 0em;'>Istituto non inserito!</p></b>";
            echo "<b><p style='color: red; text-align:center; margin-top: 0em;'>Esiste già un istituto con il codice segreto inserito!</p></b>";
          }
          mysqli_close($connE);
        }
                if ($_GET["azione"]=="MI")
				{
          $connE=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
          $controlla= "select istituto.codice from istituto where istituto.codice = '$_POST[segreto]'";
          $r = mysqli_query($connE,$controlla);
          if (mysqli_num_rows($r) == 0) {
                    $idvecchio = $_GET["codice"];
                    $idnuovo = $_POST["codicenuovo"];
                    $nome = $_POST["nome"];
                    $tipologia = $_POST["tipologia"];
                    $studenti = $_POST["studenti"];
                    $codice = $_POST["segreto"];
					$sql="update istituto set id='$idnuovo', nome='$nome', tipologia='$tipologia', studenti_iscritti='$studenti', codice='$codice' where id='$idvecchio'";
					$ris=mysqli_query($connE,$sql);
          echo "<b><p style='color: green; text-align:center; margin-top: 0em;'>Istituto modificato correttamente!</p></b>";
        } else {
          echo "<b><p style='color: red; text-align:center; margin-top: 0em;'>Istituto non inserito!</p></b>";
          echo "<b><p style='color: red; text-align:center; margin-top: 0em;'>Esiste già un istituto con il codice segreto inserito!</p></b>";
        }
					mysqli_close($connE);
				}

		}


		$conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
      $query = "SELECT *
      from istituto
      ORDER BY istituto.nome";
    $risultato=mysqli_query($conn,$query);
		if (mysqli_num_rows($risultato) != 0)
			{
				echo "<table>";
        echo "<br>";
				echo "<h2>Istituti iscritti al portale</h2>";
        echo "<a class='black' href='inserisciistituto.php' data-toggle='tooltip' title='Aggiungi istituto'><i class='material-icons' alt=''>&#xe146;</i></a>";
        echo "<br>";
        echo "<br>";
				echo "<tr><th>Codice meccanografico</th><th>Nome</th><th>Tipologia</th><th>Studenti iscritti</th><th>Codice</th></tr>";
				while ($row=mysqli_fetch_array($risultato))
				{
            echo "<tr>";
  					echo "<td class='cella'>$row[id]</td>";
  					echo "<td class='cella'>$row[nome]</td>";
  					echo "<td class='cella'>$row[tipologia]</td>";
  					echo "<td class='cella'>$row[studenti_iscritti]</td>";
  					echo "<td class='cella'>$row[codice]</td>";
            echo "<td class='cella'><a href='modificaistituto.php?azione=MI&id=$row[id]'>Modifica</a></td>";
            echo "<td class='cella'><a href='istituti.php?azione=EL&id=$row[id]' onclick=\"return confirm('sei sicuro?');\">Elimina</a></td>";
            echo "</tr>";
				}
				echo "</table>";
			}
		mysqli_close($conn);
?>
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
