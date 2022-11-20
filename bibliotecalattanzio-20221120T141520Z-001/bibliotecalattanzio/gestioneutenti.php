<?php
include 'inizio.inc';
?>
<html>
<head>
  <title>Gestione utenti</title>
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
					$sql="delete from utenti where idutente=" . $_GET["idutente"];
					$ris=mysqli_query($connE,$sql);
					mysqli_close($connE);
				}
				if ($_GET["azione"]=="IU")
				{
          if ($_POST["password1"] == $_POST["password2"]) {
          $connE=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
          $controlla= "select utenti.Username from utenti where utenti.Username = '$_POST[username]'";
					$r = mysqli_query($connE,$controlla);
					if (mysqli_num_rows($r) == 0) {
          $ruolo =$_POST["ruolo"];
          $istituto = $_SESSION["istituto"];
          $data = $_POST["data"];
          $cognome =addslashes($_POST["cognome"]);
          $nome= addslashes($_POST["nome"]);
          $telefono =  addslashes($_POST["telefono"]);
          $username= addslashes($_POST["username"]);
          $password= addslashes($_POST["password1"]);
          if (isset($_POST["classe"])) {
            $classe = $_POST["classe"];
          }
          $sql="insert into utenti (cognome,nome,telefono,username, pw, idruolo, idistituto, data_nascita) values ('$cognome','$nome','$telefono','$username','$password', '$ruolo', '$istituto', '$data')";
          $ris=mysqli_query($connE,$sql);
          if ($ruolo != '1') {
                 $query2 = "select utenti.IDUtente from utenti where utenti.username = '$username' ";
					       $risultato2 = mysqli_query($connE,$query2);
					       $row2 = mysqli_fetch_array($risultato2);
                 foreach ($classe as $classi) {
                 $sql2 ="insert into appartenenza (utente, classe) values ('$row2[IDUtente]','$classi')";
                 $ris2=mysqli_query($connE,$sql2);
               }
					       mysqli_close($connE);
          }
          echo "<b><p style='color: green; text-align:center; margin-top: 0em;'>Utente inserito correttamente!</p></b>";
        } else {
          echo "<b><p style='color: red; text-align:center; margin-top: 0em;'>Utente non inserito!</p></b>";
          echo "<b><p style='color: red; text-align:center; margin-top: 0em;'>Esiste già un utente con l'username inserito!</p></b>";
        }
      } else {
        echo "<b><p style='color: red; text-align:center; margin-top: 0em;'>Utente non inserito!</p></b>";
        echo "<b><p style='color: red; text-align:center; margin-top: 0em;'>Le due password non coincidono!</p></b>";
        }
      }
                if ($_GET["azione"]=="MU")
				{
                    $idvecchio = $_GET["idUtente"];
                    $cognome = $_POST["cognome"];
                    $nome = $_POST["nome"];
                    $username = $_POST["username"];
                    $tel = $_POST["telefono"];
                    $password = $_POST["password"];
                    $ruolo = $_POST["ruolo"];
					$connE=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
					$sql="update utenti set cognome='$cognome', nome='$nome', username='$username', telefono='$tel', pw='$password', idruolo='$ruolo' where idutente='$idvecchio'";
					$ris=mysqli_query($connE,$sql);
					mysqli_close($connE);
				}

		}


		$conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
      /*$query="SELECT utenti.IDUtente, GROUP_CONCAT(classi.nome) as classe, utenti.Nome, utenti.Username, utenti.Cognome, utenti.Telefono, utenti.PW, ruoli.Ruolo,  istituto.nome
      from appartenenza, istituto, classi, contenere, utenti inner join ruoli on utenti.idruolo=ruoli.idruolo
      where classi.id = appartenenza.classe and utenti.IDUtente = appartenenza.utente and istituto.id = contenere.istituto and classi.id = contenere.classi and utenti.IDIstituto = '" . $_SESSION["istituto"] . "' GROUP BY utenti.IDUtente";*/
      $query = "SELECT utenti.IDUtente, GROUP_CONCAT(classi.nome) as classe, utenti.Nome, utenti.Username, utenti.Cognome, utenti.Telefono, utenti.PW, ruoli.Ruolo
      from appartenenza, classi, utenti inner join ruoli on utenti.idruolo=ruoli.idruolo
      where classi.id = appartenenza.classe and utenti.IDUtente = appartenenza.utente and utenti.IDIstituto = '" . $_SESSION["istituto"] . "' GROUP BY utenti.IDUtente";
      $query2 = "SELECT utenti.IDUtente, utenti.Nome, utenti.Username, utenti.Cognome, utenti.Telefono, utenti.PW, ruoli.Ruolo
      from utenti inner join ruoli on utenti.idruolo=ruoli.idruolo
      where utenti.IDIstituto = '" . $_SESSION["istituto"] . "' GROUP BY utenti.IDUtente";
    $risultato=mysqli_query($conn,$query);
    $risultato2=mysqli_query($conn,$query2);
		if (mysqli_num_rows($risultato2) != 0)
			{
				echo "<table>";
        echo "<br>";
				echo "<h2>Elenco utenti \"$_SESSION[nistituto]\"</h2>";
        echo "<a class='black' href='inserimentoutente.php' data-toggle='tooltip' title='Aggiungi utente'><i class='material-icons' alt=''>&#xe146;</i></a>";
        echo "<br>";
        echo "<br>";
				echo "<tr><th>Cognome</th><th>Nome</th><th>Username</th><th>Telefono</th><th>Password</th><th>Ruolo</th><th>Classe</th></tr>";
				while ($row2=mysqli_fetch_array($risultato2))
				{
          switch ($row2["Ruolo"]) {
            case "Amministratore":
            echo "<tr>";
  					echo "<td class='cella'>$row2[Cognome]</td>";
  					echo "<td class='cella'>$row2[Nome]</td>";
  					echo "<td class='cella'>$row2[Username]</td>";
  					echo "<td class='cella'>$row2[Telefono]</td>";
            echo "<td class='cella'>Non visibile</td>";
  					echo "<td class='cella'>$row2[Ruolo]</td>";
            echo "<td class='cella' width='20'>Nessuna classe</td>";
            if ($row2["IDUtente"] == $_SESSION["idutente"]) {
              echo "<td class='cella'><a href='modificautente.php?azione=MU&idutente=$row2[IDUtente]'>Modifica</a></td>";
            }
            echo "</tr>";
            break;
            case "Utente":
            $row=mysqli_fetch_array($risultato);
            echo "<tr>";
  					echo "<td class='cella'>$row[Cognome]</td>";
  					echo "<td class='cella'>$row[Nome]</td>";
  					echo "<td class='cella'>$row[Username]</td>";
  					echo "<td class='cella'>$row[Telefono]</td>";
  					echo "<td class='cella'>$row[PW]</td>";
  					echo "<td class='cella'>$row[Ruolo]</td>";
            echo "<td class='cella'>$row[classe]</td>";
  					echo "<td class='cella'><a href='gestioneutenti.php?azione=EL&idutente=$row[IDUtente]' onclick=\"return confirm('sei sicuro?');\">Elimina</a></td>";
  					echo "</tr>";
            break;
            case "Prof":
            $row=mysqli_fetch_array($risultato);
            echo "<tr>";
  					echo "<td class='cella'>$row[Cognome]</td>";
  					echo "<td class='cella'>$row[Nome]</td>";
  					echo "<td class='cella'>$row[Username]</td>";
  					echo "<td class='cella'>$row[Telefono]</td>";
  					echo "<td class='cella'>$row[PW]</td>";
  					echo "<td class='cella'>$row[Ruolo]</td>";
            echo "<td class='cella'>$row[classe]</td>";
  					echo "<td class='cella'><a href='gestioneutenti.php?azione=EL&idutente=$row[IDUtente]' onclick=\"return confirm('sei sicuro?');\">Elimina</a></td>";
  					echo "</tr>";
            break;
          }
          /*$row2=mysqli_fetch_array($risultato2);
					echo "<tr>";
					echo "<td class='cella'>$row[Cognome]</td>";
					echo "<td class='cella'>$row[Nome]</td>";
					echo "<td class='cella'>$row[Username]</td>";
					echo "<td class='cella'>$row[Telefono]</td>";
          if ($row["Ruolo"] == "Amministratore") {
            echo "<td class='cella'>Password non visibile</td>";
          } else {
					echo "<td class='cella'>$row[PW]</td>";
         }
					echo "<td class='cella'>$row[Ruolo]</td>";
          if ($row["Ruolo"] == "Amministratore") {
            echo "<td class='cella'>Nessuna classe</td>";
          } else {
            echo "<td class='cella'>$row2[classe]</td>";
         }
					echo "<td class='cella'><a href='gestioneutenti.php?azione=EL&idutente=$row[IDUtente]' onclick=\"return confirm('sei sicuro?');\">Elimina</a></td>";
					echo "</tr>";*/
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
