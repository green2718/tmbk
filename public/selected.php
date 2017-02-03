<?php
session_start();
include "../db/config.php";
include "../db/db_functions.php";

if (!array_key_exists('kittens', $_SESSION))
{
  http_response_code(409);
  return;
}
if (!array_key_exists("kitten", $_GET))
{
  http_response_code(400);
  return;
}
$selected = (int) $_GET["kitten"];
if (!in_array($selected, $_SESSION["kittens"]))
{
  http_response_code(409);
  return;
}
try
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  saveKittens($selected, $_SESSION["kittens"], $conn, $kitten_table, $assoc_table);
  include "select_kitten.php";
}
catch(PDOException $e)
{
  http_response_code(500);
  return;
}
?>
