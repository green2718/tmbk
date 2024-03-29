<?php
// Need to be included in a file with a PDO Object on var $conn, and the DB name listed
$creation_revision_table = "CREATE TABLE $revision_table (
  id INT(6) UNSIGNED PRIMARY KEY,
  date TIMESTAMP
)";
$conn -> exec($creation_revision_table);
echo "Revision Table created\n";

$creation_kitten_table = "CREATE TABLE $kitten_table (
  id INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  link VARCHAR(100) NOT NULL,
  nb_call INT(16) UNSIGNED DEFAULT 0,
  rank INT(16) UNSIGNED DEFAULT 0
)";
$conn -> exec($creation_kitten_table);
echo "Kitten Table created\n";

$creation_assoc_table = "CREATE TABLE $assoc_table (
  id1 int(16) UNSIGNED NOT NULL,
  id2 int(16) UNSIGNED NOT NULL,
  val1 int(12) UNSIGNED DEFAULT 0,
  val2 int(12) UNSIGNED DEFAULT 0,
  CONSTRAINT pk_kitten PRIMARY KEY (id1, id2),
  CONSTRAINT fk_1 FOREIGN KEY (id1) REFERENCES $kitten_table(id),
  CONSTRAINT fk_2 FOREIGN KEY (id2) REFERENCES $kitten_table(id)
)";
$conn -> exec($creation_assoc_table);
echo "Assocation table created\n";

$save_revision = "INSERT INTO $revision_table VALUES ($val_revision, NOW())";
$conn -> exec($save_revision);
echo "Init OK\n";
?>
