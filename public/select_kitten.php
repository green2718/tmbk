<?php
if ($_SESSION = NULL) 
{
  session_start();
}

include "../db/config.php";
//include "../db/db_functions.php";
function selectKittens($conn, $kitten_table) 
{
  $k = $conn -> query("SELECT * FROM $kitten_table LIMIT 10;");
  $aa = $k -> fetchAll();
  return array(
    $aa[rand(0,4)],
    $aa[rand(5,9)]
  );
}
echo '<div>';
try
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $_SESSION["kittens"] = array();
  $kittens = selectKittens($conn, $kitten_table);
  foreach($kittens as $kitten)
  {
    echo "<div>";
    echo "<a href='selected.php?kitten=$kitten[id]'>";
    echo "<img src='$kitten[link]' alt='Chaton mignon'/>";
    echo "</a></div>";
    array_push($_SESSION["kittens"], $kitten['id']);
  }
}
catch(PDOException $e)
{
  echo "<p>Une erreur s'est produite, nous ne sommes malheureusement pas en mesure de vous présenter de chatons à choisir.</p>";
  echo "<p>Voici quand même pour nous excuser un GIF de chaton :</p>";
  $rndKitten = rand(1,247);
  echo "<img src='http://www.catgifpage.com/gifs/$rndKitten.gif' alt='chaton désolé'>";
  echo "<p>Désolé pour la peine causée ! =(</p>";
}
echo '</div>';
?>
