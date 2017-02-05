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

  $current_revision = $conn -> query("SELECT id FROM $revision_table;") -> fetchColumn();

  if ($current_revision < 2)
  {
    $val_revision = 2;
    include 'rev2.php';
  }

  if ($val_revision != $current_revision)
  {
    $conn -> exec("DELETE FROM $revision_table;");
    $save_revision = "INSERT INTO $revision_table VALUES ($val_revision, NOW())";
    $conn -> exec($save_revision);
  }
  echo "Generation OK!\n";
}
catch(PDOException $e)
{
  echo "SQL Error:" . $e->getMessage();
}
$conn = NULL;
?>
