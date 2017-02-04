<?php
include '../config.php';
try
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  include '../db_functions.php';


  // Kitten on Warrick:
  $baseurl_warrick = "https://warrick.rez-gif.supelec.fr/kitty/";
  for ($i = 1; $i < 659; $i++)
  {
    addKitten($baseurl_warrick . $i . ".jpg", $conn, $kitten_table, $assoc_table);
  }
}
catch(PDOException $e)
{
  echo "SQL Error:" . $e->getMessage();
}
$conn = NULL;
?>
