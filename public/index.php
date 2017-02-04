<?php
  session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>TMBK: awesome!</title>
        <link rel="stylesheet" type="text/css" href="tmbk.css">
    </head>
</html>
<body>
  <h1><span>Bienvenue sur&nbsp;</span><strong class="title">The Most Beautiful Kitten</strong></h1>
  <div class="intro">
    <p>
       Le but de ce site est de déterminer, parmi les <strong>chatons</strong>, lequel est le plus mignon.<br/>
       Nous sommes d'accord que <span class="it">TOUS</span> les <strong>chatons</strong> sont mignons, nous chercherons juste à savoir lequel l'est le plus.
    </p>
    <p>
      Pour cela, votre aide est nécessaire&nbsp;: il faudra cliquer sur le <strong>chaton</strong> le plus mignon des deux. Petit à petit, nous pourrons déterminer lequel est le plus mignon.
    </p>
    <p>
      Rassurez-vous&nbsp;: si les deux sont trop mignons, il est toujours possible de passer aux suivants en cliquant au milieu.
    </p>
    <p>
      Maintenant, à vous de jouer&nbsp;!
    </p>
  </div>
  <div id="kittyArea">
    <?php include "select_kitten.php"; ?>
  </div>
  <script src="tmbk.js"></script>
</body>
