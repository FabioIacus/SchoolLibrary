<?php
include 'inizio.inc';
?>
<html>
<head>
  <title>Video</title>
  <meta charset="windows-1252">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  h2 {
    text-align: center;
  }
  table {
    border-collapse: collapse;
  }
  th {
    background-color: #f1f1f1;
    color: black;
    border-bottom: 1px solid black;
  }
  .left {
    border-right: 1px solid black;
    width:500px;
    text-align: center;
  }
  .right {
    width:500px;
    border:none;
  }
  .collapsible {
    background-color: #777;
    color: white;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
  }

  .active, .collapsible:hover {
    background-color: #555;
  }

  .collapsible:after {
    content: '\002B';
    color: white;
    font-weight: bold;
    float: right;
    margin-left: 5px;
  }

  .active:after {
    content: "\2212";
  }

  .content {
    padding: 0 18px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    background-color: #f1f1f1;
    word-wrap: break-word;
  }
  a {
    text-decoration:none;
  }
  .button1 {
    background-color: white;
    border: 2px solid #4CAF50;
    color: black;
    padding: 10px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 3px;
    cursor: pointer;
    width:180px;
  }
  .button1:hover {
  background-color: #4CAF50;
  color: white;
  }
  </style>
</head>
<?php
if (isset($_GET["var"])) {
  echo "<body>";
}
else {
  echo "<body onload='indice0()'>";
}?>
  <section>
  <article>
    <h2>Video caricati da te</h2>
    <?php
    if (isset($_SESSION['statoutente']))
    {

    switch ($_SESSION["statoutente"])
     {

   	case "Prof":
    ?>
    <p>
    <a style="cursor: pointer" class="black" href="materiale.php" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
    </p>
    <table style="float:right">
      <tr>
    <td><a href="inseriscivideo.php" style="color:#091534"><button class="button1">Inserisci video</button></a>
    </td><td><a href="eliminavideo.php" style="color:#091534"><button class="button1">Elimina video</button></a>
    </td>
  </tr>
    </table>
    <br>
    <br>
    <br>
    <h3>Seleziona anno:</h3>
    <?php
    $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error()); //connessione al database
    $query = "select video.src, video.id, video.descrizione, condividere3.anno
              from video, utenti, condividere3
              where utenti.IDUtente = condividere3.insegnante and condividere3.video = video.id and utenti.IDUtente = " . $_SESSION["idutente"] . "
              group by condividere3.anno";     //query per stampare le informazione sul singolo anno
    $risultato = mysqli_query($connessione, $query);  //esegue query
    if (mysqli_num_rows($risultato) != 0) {
      while ($row = mysqli_fetch_array($risultato)) {
        echo "<button class='collapsible'>$row[anno]</button>";
        echo "<div class='content'>";
        $query2 = "select video.id, video.src, video.descrizione, condividere3.anno
                  from video, utenti, condividere3
                  where utenti.IDUtente = condividere3.insegnante and condividere3.video = video.id and condividere3.anno = ". $row["anno"] . " and utenti.IDUtente = " . $_SESSION["idutente"] . "
                  group by video.id";     //query per stampare le informazione sul singolo video
        $risultato2 = mysqli_query($connessione, $query2);  //esegue query
        while ($row2 = mysqli_fetch_array($risultato2)) {
          echo "<table>";
          echo "<tr>";?>
          <td>
            <video width="220" height="140" controls><source src="video\<?php echo $row2["src"] ?>.mp4" type="video/mp4"></video>
          </td>
          <?php
          echo "<td>$row2[descrizione]</td>";
          echo "</tr>";
          echo "</table>";
        }
      echo "</div>";
      }
    }

    if (mysqli_num_rows($risultato) == 0) {
        echo "<h2>Non ci sono dati.</h2>";
    }
    mysqli_close($connessione);
    ?>
    <?php
    break;
    case "Utente":
    ?>
    <p>
    <a style="cursor: pointer" class="black" href="materiale.php" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
    </p>
    <br>
    <?php
    $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
    //ESTRAI ISTITUTO
    $query="SELECT utenti.IDIstituto from utenti where utenti.IDUtente = " . $_SESSION["idutente"] . "";
    $risultato=mysqli_query($conn,$query);
    $row = mysqli_fetch_array($risultato);
    $istituto = $row["IDIstituto"];
    //ESTRAI CLASSE
    $query2="SELECT classi.id, classi.nome from classi, appartenenza, utenti where classi.id = appartenenza.classe and utenti.IDUtente = appartenenza.utente and appartenenza.utente = " . $_SESSION["idutente"] . "";
    $risultato2=mysqli_query($conn,$query2);
    $row2 = mysqli_fetch_array($risultato2);
    $classe = $row2["id"];
    $nome = $row2["nome"];
    //ESTRAI PROFESSORI
    $query3="SELECT utenti.IDUtente, utenti.nome, utenti.cognome
     from utenti, ruoli, appartenenza, classi, istituto
     where utenti.IDRuolo = ruoli.IDRuolo and utenti.IDUtente = appartenenza.utente and classi.id = appartenenza.classe and istituto.id = utenti.IDIstituto
     and utenti.IDRuolo = '3' and utenti.IDIstituto = '$istituto' and appartenenza.classe = '$classe'";
    $risultato3=mysqli_query($conn,$query3);
    if (mysqli_num_rows($risultato3) != 0){
      echo "<p>Classe:  $nome</p>";
      echo "Seleziona prof: ";
      echo "<select name=\"id\" id='mySelect' onchange='selezionaprof()'' required>";
      while ($row3=mysqli_fetch_array($risultato3)) {
        if (isset($_GET["var"])) {
          echo "<option value=\"$_GET[var]\" selected>$_GET[txt]</option>";
          if ($row3["IDUtente"] == $_GET["var"]) {
          } else {
          echo "<option value=\"$row3[IDUtente]\">$row3[nome] $row3[cognome]</option>";
        }
          $tmp = $_GET["var"];
          $_GET["var"] = null;
        } else {
          if ($row3["IDUtente"] == $tmp) {
          } else {
        echo "<option value=\"$row3[IDUtente]\">$row3[nome] $row3[cognome]</option>";
      }
      }
      }
      echo "</select>";
      if (isset($_GET["f"])) {
      if ($_GET["f"] == 'true') {
      echo "<h3>Seleziona anno:</h3>";
      $query4 = "select video.src, video.id, video.descrizione, condividere3.anno
                from video, utenti, condividere3
                where utenti.IDUtente = condividere3.insegnante and condividere3.video = video.id and utenti.IDUtente = $tmp
                group by condividere3.anno";     //query per stampare le informazione sul singolo anno
      $risultato4 = mysqli_query($conn, $query4);  //esegue query
      if (mysqli_num_rows($risultato4) != 0) {
        while ($row4 = mysqli_fetch_array($risultato4)) {
          echo "<button class='collapsible'>$row4[anno]</button>";
          echo "<div class='content'>";
          $query5 = "select video.id, video.src, video.descrizione, condividere3.anno
                    from video, utenti, condividere3
                    where utenti.IDUtente = condividere3.insegnante and condividere3.video = video.id and condividere3.anno = ". $row4["anno"] . " and utenti.IDUtente = $tmp
                    group by video.id";     //query per stampare le informazione sul singolo video
          $risultato5 = mysqli_query($conn, $query5);  //esegue query
          while ($row5 = mysqli_fetch_array($risultato5)) {
            echo "<table>";
            echo "<tr>";?>
            <td>
              <video width="220" height="140" controls><source src="video\<?php echo $row5["src"] ?>.mp4" type="video/mp4"></video>
            </td>
            <?php
            echo "<td>$row5[descrizione]</td>";
            echo "</tr>";
            echo "</table>";
          }
        echo "</div>";
        }
      }
      if (mysqli_num_rows($risultato4) == 0) {
          echo "<h2>Non ci sono dati.</h2>";
      }
    } else {
      echo "<p>Non sono associati professori</p>";
    }
  }
}
    mysqli_close($conn);
    break;
  }
}
     ?>
    <script>
      var coll = document.getElementsByClassName("collapsible");
      var i;

      for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.maxHeight){
            content.style.maxHeight = null;
          } else {
            content.style.maxHeight = content.scrollHeight + "px";
          }
        });
      }
  </script>
  <script>
  function selezionaprof() {
  var x = document.getElementById("mySelect").value;
  var y = document.getElementById("mySelect").selectedIndex;
  var z = document.getElementById("mySelect").options;
  var f = true;
  window.location.href = "https://bibliotecalattanzio.000webhostapp.com/caricavideo.php?var=" + x + "&ind=" + y + "&txt=" + z[y].text + "&f=" + f;
  }
  function indice0() {
  document.getElementById("mySelect").selectedIndex = "-1";
}
  </script>
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
