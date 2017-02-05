<?php
if (!isset($_SESSION)) 
{
  session_start();
}
include "../db/config.php";
include "../db/db_functions.php";

if (array_key_exists('equal', $_GET) && (int) $_GET['equal'] == 1 && array_key_exists('kittens', $_SESSION) && $_SESSION["send"] == true)
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  saveEqual($_SESSION['kittens'], $conn, $kitten_table, $assoc_table);
}

include "../model_kitten.php";
?>
