<?php
include 'inizio.inc';
?>
<html>
<head>
  <title>Materiale Multimediale</title>
  <meta charset="windows-1252">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  .cella {
      border:1px blue solid;
      padding: 5px;
  }
  table {
      border-collapse: collapse;
  }
  article {
    text-align: center;
  }
  .row {
    margin: 10px -16px;
  }
  /* Create three equal columns that floats next to each other */
  .column1 {
    float: left;
    width: 50%;
    display: block;
    padding-right: 20px;
    padding-left: 60px;
    padding-bottom: 20px;
  }
  .column2 {
    float: left;
    width: 50%;
    display: block;
    padding-right: 60px;
    padding-bottom: 20px;
  }

  /* Clear floats after rows */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  /* Content */
  .content {
    background-color: white;
    padding: 10px;
    height: 180px;
    cursor: pointer;
  }
  .img {
    height:113px;
  }
  a {
    text-decoration:none;
  }
  </style>
</head>
<body>
  <section>
  <article>
    <h2>Seleziona la categoria</h2>
    <!-- Portfolio Gallery Grid -->
    <div class="row">
      <div class="column1">
        <a href="videoyt.php" style="color:#091534"><div class="content">
          <img src="Youtube.png" alt="Youtube" class="img" style="width:100%">
          <h4>Video su Youtube</h4>
        </div></a>
      </div>
      <div class="column2">
        <a href="sitografie.php" style="color:#091534"><div class="content">
          <img src="Sitografia.jpg" alt="Sitografie" class="img" style="width:100%">
          <h4>Sitografie</h4>
        </div></a>
      </div>
      <div class="column1">
        <a href="caricavideo.php" style="color:#091534"><div class="content">
          <img src="Videocamera.jpg" alt="Videocamera" class="img" style="width:100%">
          <h4>Video caricati da te</h4>
        </div></a>
      </div>
      <div class="column2">
        <a href="documenti.php" style="color:#091534"><div class="content">
          <img src="Documenti.jpg" alt="Documenti" class="img" style="width:100%">
          <h4>Documenti di approfondimento</h4>
        </div></a>
      </div>
    </div>
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
