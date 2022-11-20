<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Biblioteca</title>
        <link rel="icon" href="Icona.ico">
		<style>
    * {
      box-sizing: border-box;
    }
		img.rounded {
			border-radius: 50%;
			max-width: 100%
		}
    .art {
      background-color:#ffd662;
    	width: 80%;
    	overflow: auto;
    	float: left;
      height: 600px;
    }
    #snackbar {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: #333;
      color: #fff;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 1;
      left: 50%;
      top: 30px;
      font-size: 17px;
    }

    #snackbar.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

@-webkit-keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 30px; opacity: 1;}
}

@keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {top: 30px; opacity: 1;}
  to {top: 0; opacity: 0;}
}

@keyframes fadeout {
  from {top: 30px; opacity: 1;}
  to {top: 0; opacity: 0;}
}
.container {
  position: relative;
  max-width: 1200px;
  margin: 0 auto;
  height:600px;
}

.container img {vertical-align: middle;height:600px;}

.container .content {
  position: absolute;
  top: 0;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}
		</style>
    </head>
    <?php
    if (isset($_GET["var"])) {
      if ($_GET["var"] == "vero") {
	       echo "<body onload='benvenuto()'>";
       } else {
         echo "<body>";
       }
    }
    ?>
    <script>
    function benvenuto() {
      var x = document.getElementById("snackbar");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>
<div id="snackbar">Benvenuto <?php echo $_SESSION["nome"] ?>!</div>
	<section>
	<div class="art">
    <div class="container">
  <img src="Icona.jpeg" alt="Logo" style="width:100%;">
  <?php
  if (isset($_SESSION["statoutente"])) {?>
    <div class="content">
      <h1>Ciao, oggi è  <span id="demo"></span>!</h1>
        <script>
        var oggi = new Date();
        var giorno;
        switch (oggi.getDay()) {
          case 0:
          giorno = "domenica";
          break;
          case 1:
          giorno = "lunedì";
          break;
          case 2:
          giorno = "martedì";
          break;
          case 3:
          giorno = "mercoledì";
          break;
          case 4:
          giorno = "giovedì";
          break;
          case 5:
          giorno = "venerdì";
          break;
          case 6:
          giorno = "sabato";
          break;
        }
        document.getElementById("demo").innerHTML = giorno;
        </script>
      <p>Cosa vuoi fare?</p>
    </div>
  <?php } else {?>
  <div class="content">
    <h1>Benvenuto su Biblioteca Digitale!</h1>
    <p>Per iniziare, registrati o accedi al portale.</p>
  </div>
  <?php }
  ?>
</div>
  </div>
  <aside>
    <table><caption>La biblioteca</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php/biblioteca.html" target="_blank"><img class="rounded"src="https://www.divittoriolattanzio.it/home/images/biblioteca.jpg" width="100%" height="85px"></a></td></tr></table>
    <br>
    <table><caption>L'istituto</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php" target="_blank"><img src="https://www.divittoriolattanzio.it/home/images/logo-scuola.png" width="100%" height="85px"></a></td></tr></table>
  </aside>
	</section>
  <footer>
    Made by Fabio Iacus © 2020
 </footer>
