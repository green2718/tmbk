<?php
try
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $_SESSION["kittens"] = array();
  $kittens = selectKittens($conn, $kitten_table);
  foreach($kittens as $kitten)
  {
    echo "<div>";
    echo "<a class='kitty' href='javascript:void(0);' data='$kitten[id]'>";
    echo "<img src='$kitten[link]' alt='Chaton mignon'/>";
    echo "</a></div>";
    array_push($_SESSION["kittens"], $kitten['id']);
  }
  echo "<a id='reset' href='javascript:void(0);' >Je ne peux me décider&nbsp;!</a>";
}
catch(PDOException $e)
{
  echo "<p>Une erreur s'est produite, nous ne sommes malheureusement pas en mesure de vous présenter de chatons à choisir.</p>";
  echo "<p>Voici quand même pour nous excuser un GIF de chaton :</p>";
  $rndKitten = rand(1,247);
  echo "<img src='http://www.catgifpage.com/gifs/$rndKitten.gif' alt='chaton désolé'>";
  echo "<p>Désolé pour la peine causée ! =(</p>";
}
?>
