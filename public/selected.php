<?php
session_start();
include "../db/config.php";
include "../db/db_functions.php";

if (!array_key_exists('kittens', $_SESSION) || $_SESSION["send"] == false)
{
  http_response_code(409);
  echo "No session";
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
  echo "Not in array";
  return;
}
list($usec, $sec) = explode(" ", $_SESSION["timeReq"]);
$timeExec = (float)$usec + (float)$sec ;
if ( microtime(true) - $timeExec < 1) {
  echo $timeExec . "\n";
  echo microtime(true);
  http_response_code(429);
  return;
}

$_SESSION["send"] = false;
try
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  saveKittens($selected, $_SESSION["kittens"], $conn, $kitten_table, $assoc_table);
  include "../model_kitten.php";
}
catch(PDOException $e)
{
  http_response_code(500);
  return;
}
?>
