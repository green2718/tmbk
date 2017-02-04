<?php
if (!isset($_SESSION)) 
{
  session_start();
}
include "../db/config.php";
include "../db/db_functions.php";
include "../model_kitten.php";
?>
