<?php ob_start(); ?>
<?php
include 'inizio.inc';
$titolo = $_GET["titolo"];
$codice = $_GET["codice"];
?>
<html>
    <head>
        <title><?php echo $titolo ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        .fa {
            font-size: 25px;
          }
          .rec {
            width:20%;
            margin-left: 40%;
            margin-right:40%;
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 13px 32px;
            text-align: center;
            text-decoration: none;
            display: block;
            font-size: 16px;
            margin: 0 16px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
          }
          .rec:hover {
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
          }
	      .cella {
            border:1px black solid;
            padding: 5px;
        }
        .article1 {
          padding: 20px;
          background-color:#ffd662;
        	width: 80%;
        	overflow: auto;
        	float: left;
          height: 370px;
        }
        .article2 {
          padding: 20px;
          background-color:#ffd662;
        	width: 80%;
        	overflow: auto;
        	float: left;
          height: 360px;
        }
        .article3 {
          padding: 20px;
          background-color:#ffd662;
        	width: 80%;
        	overflow: hidden;
        	float: left;
          height: 90px;
        }
        .aside1 {
          float:right;
        	width:20%;
        	padding: 20px;
          background-color:#ffd662;
        	overflow: auto;
          border-left: 6px double black;
          height: 820px;
        }
        table {
            border-collapse: collapse;
        }
        img.libro {
          float: left;
          padding-right: 20px;
          padding-left: 15px;
        }
        img.rounded {
    			border-radius: 50%;
    			max-width: 100%
    		}
        /* Style the container with a rounded border, grey background and some padding and margin */
        .contenitore {
          border: 2px solid #ccc;
          background-color: #eee;
          border-radius: 5px;
          padding: 16px;
          margin: 0 16px;
          word-wrap: break-word;
        }

          /* Clear floats after containers */
          .contenitore::after {
            content: "";
            clear: both;
            display: table;
          }
          /* Increase the font-size of a span element */
          .contenitore span {
            font-size: 20px;
            margin-right: 15px;
          }

          /* Add media queries for responsiveness. This will center both the text and the image inside the container */
          @media (max-width: 500px) {
            .contenitore {
              text-align: center;
            }
          }
          #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
          }

          #myImg:hover {opacity: 0.7;}

          /* The Modal (background) */
          .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
          }

/* Modal Content (image) */
.modal-content {
  margin-left: 40%;
  margin-right: 40%;
  display: block;
  width: 80%;
  max-width: 300px;
  max-height: 500px;
}

/* Add Animation */
.modal-content {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform: scale(0.1)}
  to {transform: scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 50px;
  right: 350px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
div.modifica {
  font-family: Verdana, Arial, sans-serif;
  font-weight: bold;
  float:left;
  display:block;
  list-style-type: none;
}
div.modifica2 {
  font-size: 18px;
  display: block;
}
        </style>
    </head>
    <body>
		<section>
		<article class="article1">

        <?php
            $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error()); //connessione al database
            $query = "select libri.codice, libri.titolo, libri.editore, libri.annopubblic, editori.nome, GROUP_CONCAT(autori.nome) as aut
                      from libri, editori, scrittura, autori
                      where libri.editore = editori.ideditore and libri.codice = scrittura.libro and autori.idautore = scrittura.autore and libri.codice = $_GET[codice]
                      group by libri.codice";     //query per stampare le informazione sul singolo libro
            $risultato = mysqli_query($connessione, $query);  //esegue query
            if (mysqli_num_rows($risultato) != 0) {      //se il numero di righe restituite è diverso da 0
              ?>
              <p style="margin-left: 12px;">
             	<a style="cursor: pointer" class="black" onclick=<?php
              if ($_SESSION["statoutente"] == "Utente") {echo "location: href='elencolibriU.php'";} else {echo "location: href='elencolibri.php'";}
              ?> data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
          		</p>
              <img id="myImg" class="libro" src="immagini\<?php echo $titolo ?>.jpg" alt="Copertina" width="200px" height="250px">
              <!-- The Modal -->
              <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
              </div>
              <script>
              // Get the modal
              var modal = document.getElementById('myModal');

              // Get the image and insert it inside the modal - use its "alt" text as a caption
              var img = document.getElementById('myImg');
              var modalImg = document.getElementById("img01");
              img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
              }

              // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks on <span> (x), close the modal
                  span.onclick = function() {
                    modal.style.display = "none";
                  }
                  </script>
              <p>
                <?php
                $row = mysqli_fetch_array($risultato);
                echo "<div class='modifica'>ISBN: &nbsp&nbsp</div><div class='modifica2'>$row[codice]</div>
                <div class='modifica'>Titolo: &nbsp&nbsp</div><div class='modifica2'>$row[titolo]</div>
                <div class='modifica'>Autore/i: &nbsp&nbsp</div><div class='modifica2'>$row[aut]</div>
                <div class='modifica'>Editore/i: &nbsp&nbsp</div><div class='modifica2'>$row[nome]</div>
                <div class='modifica'>Anno pubblicazione: &nbsp&nbsp</div><div class='modifica2'>$row[annopubblic]</div>
                <div style='clear:both;'></div>";
                ?>
              </p>
            <?php
            }
            if (mysqli_num_rows($risultato) == 0) {
                echo "<h2>C'è stato un errore. La preghiamo di riprovare più tardi.</h2>";
            }
            mysqli_close($connessione);
        ?>
		</article>
    <aside class="aside1">
      <table><caption>La biblioteca</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php/biblioteca.html" target="_blank"><img class="rounded"src="https://www.divittoriolattanzio.it/home/images/biblioteca.jpg" width="100%" height="85px"></a></td></tr></table>
  <br>
      <table><caption>L'istituto</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php" target="_blank"><img src="https://www.divittoriolattanzio.it/home/images/logo-scuola.png" width="100%" height="85px"></a></td></tr></table>
    </aside>
    <article class="article3">
      <hr style="width: 200px; border: 1px solid blue;">
      <p style="text-align:center; font-size:24px">
      Recensioni
      </p>
    </article>
    <article class="article2">
      <?php
      $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error()); //connessione al database
      $query = "select libri.codice, utenti.nome, utenti.cognome, utenti.idutente, recensioni.utente, recensioni.voto, recensioni.id, recensioni.libro, recensioni.testo, DATE_FORMAT(recensioni.data,'%d-%m-%Y') as data_f
                from libri, utenti, recensioni
                where libri.codice = recensioni.libro and recensioni.utente = utenti.idutente and libri.codice = $_GET[codice]
                order by recensioni.data";     //query per stampare le informazioni
      $risultato = mysqli_query($connessione, $query);  //esegue query
      if (isset($_SESSION["statoutente"])) {
        if ($_SESSION["statoutente"] == "Utente" || $_SESSION["statoutente"] == "Prof") {
          echo "<a href='inseriscirec.php?libro=$codice&titolo=$titolo' style='color:#091534'><button class='rec'>Inserisci una recensione</button></a>";
          echo "<br>";
        }
      }
      if (mysqli_num_rows($risultato) != 0) {      //se il numero di righe restituite è diverso da 0
        while ($row =  mysqli_fetch_array($risultato)) {
          echo "<div class='contenitore'>";
          if ($_SESSION["statoutente"] == "Amministratore") {
              echo "<p><span>$row[nome] $row[cognome]</span> <i>il $row[data_f]</i>";
              echo "<span style='float: right'><a style='cursor: pointer;float: right;color: red' href='esegui.php?azione=ELIMINA_REC&id=$row[id]&libro=$codice&titolo=$titolo' data-toggle='tooltip' title='Elimina recensione' onclick=\"return confirm('Sei sicuro?');\"><i style='font-size:24px' class='fas'>&#xf00d;</i></a></p>";
              echo "<span style='float:right'>Voto(1-5): $row[voto]</span>";
          }
          if ($_SESSION["statoutente"] == "Utente") {
          if ($row["idutente"] == $_SESSION["idutente"]) {
            echo "<table style='float:right; margin-right:14px'>";
            echo "<tr>";
            echo "<td><a style='cursor: pointer;float: right;color: black' href='modificarec.php?&id=$row[id]&testo=$row[testo]&libro=$codice&titolo=$titolo' data-toggle='tooltip' title='Modifica recensione'><i style='font-size:24px' class='fas'>&#xf044;</i></a></td>";
            echo "<td>";
            echo "</td>";
            echo "<td><a style='cursor: pointer;float: right;color: red' href='esegui.php?azione=ELIMINA_REC&id=$row[id]&libro=$codice&titolo=$titolo' data-toggle='tooltip' title='Elimina recensione' onclick=\"return confirm('Sei sicuro?');\"><i style='font-size:24px' class='fas'>&#xf00d;</i></a></td>";
            echo "</tr>";
            echo "</table>";
            echo "&nbsp";
            echo "<p><span>$row[nome] $row[cognome]</span> <span style='float:right'>Voto(1-5): $row[voto]</span> <i>il $row[data_f]</i></p>";
          } else {
            echo "<p><span>$row[nome] $row[cognome]</span> <span style='float:right'>Voto(1-5): $row[voto]</span> <i>il $row[data_f]</i></p>";
          }
          }
          if ($_SESSION["statoutente"] == "Prof") {
          if ($row["idutente"] == $_SESSION["idutente"]) {
            echo "<table style='float:right; margin-right:14px'>";
            echo "<tr>";
            echo "<td><a style='cursor: pointer;float: right;color: black' href='modificarec.php?&id=$row[id]&testo=$row[testo]&libro=$codice&titolo=$titolo' data-toggle='tooltip' title='Modifica recensione'><i style='font-size:24px' class='fas'>&#xf044;</i></a></td>";
            echo "<td>";
            echo "</td>";
            echo "<td><a style='cursor: pointer;float: right;color: red' href='esegui.php?azione=ELIMINA_REC&id=$row[id]&libro=$codice&titolo=$titolo' data-toggle='tooltip' title='Elimina recensione' onclick=\"return confirm('Sei sicuro?');\"><i style='font-size:24px' class='fas'>&#xf00d;</i></a></td>";
            echo "</tr>";
            echo "</table>";
            echo "&nbsp";
            echo "<p><span>$row[nome] $row[cognome]</span> <span style='float:right'>Voto(1-5): $row[voto]</span> <i>il $row[data_f]</i></p>";
          } else {
            echo "<p><span>$row[nome] $row[cognome]</span> <span style='float:right'>Voto(1-5): $row[voto]</span> <i>il $row[data_f]</i></p>";
          }
          }
          echo "<p>$row[testo]</p>";
          echo "</div>";
        }
      }
      else {
        echo "<div class='contenitore'>";
        echo "<p>Non ci sono recensioni</p>";
        echo "</div>";
      }
       ?>
    </article>
		</section>
    <footer>
      Made by Fabio Iacus © 2020
   </footer>
    </body>
</html>
