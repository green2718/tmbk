<?php
include '../config.php';

try
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $exist = $conn->query("SHOW TABLES LIKE '$revision_table';");
  if ($exist->rowCount() == 0)
  {
    $val_revision = 1;
    include 'init.php';
  }
  echo "Generation OK!\n";
}
catch(PDOException $e)
{
  echo "SQL Error:" . $e->getMessage();
}
?>
