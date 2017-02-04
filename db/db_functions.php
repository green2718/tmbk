<?php
function addKitten($url, $conn, $kitten_table, $assoc_table)
{
  //echo "add kitten $url\n";
  $exist = $conn -> query("SELECT * FROM $kitten_table WHERE (link='$url');");
  if ($exist -> rowCount() > 0)
  {
    //echo "Kitten already in DB! Exit.\n";
    return false;
  }
  //echo "Add kitten in DB.\n";
  $conn -> exec("INSERT INTO $kitten_table (link) VALUES ('$url');");

  //echo "Get id of kitten.\n";
  $id = $conn->query("SELECT id FROM $kitten_table WHERE (link='$url');") -> fetch()['id'];

  //echo "Prepare insert request in assoc table.\n";
  $insert_assoc = $conn->prepare("INSERT INTO $assoc_table (id1, id2) VALUES (:smallId, :bigId);");
  $insert_assoc->bindParam(':smallId', $smallId);
  $insert_assoc->bindParam(':bigId', $bigId);

  //echo "Find others kitten ids.\n";
  $others_kitten = $conn->query("SELECT id FROM $kitten_table WHERE (link!='$url');");
  //echo "Insert kittens associations.\n";
  foreach($others_kitten->fetchAll(PDO::FETCH_COLUMN, 'id') as $otherId)
  {
    if ($id < $otherId)
    {
      $smallId = $id;
      $bigId = $otherId;
    } else {
      $smallId = $otherId;
      $bigId = $id;
    }
    $insert_assoc->execute();
  }
  //echo "Kitten added!\n";
}

function selectKittens($conn, $kitten_table) {
  $nbKittens = 0;
  $min = -1;
  $reqMin = $conn -> prepare("SELECT MIN(nb_call) FROM $kitten_table WHERE (nb_call > :min);");
  $reqMin -> bindParam(':min', $min);
  $reqKittens = $conn -> prepare("SELECT * FROM $kitten_table WHERE (nb_call <= :min);", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
  $reqKittens -> bindParam(':min', $min);
  do
  {
    $reqMin -> execute();
    $min = $reqMin -> fetch()['MIN(nb_call)'];
    $reqKittens -> execute();
    $nbKittens = $reqKittens -> rowCount();
  } while ($nbKittens < 2);

  $posKitten1 = rand(0, $nbKittens - 1);
  $posKitten2 = rand(0, $nbKittens - 2);
  $max = $posKitten1;
  if ($posKitten2 >= $posKitten1) {
    $posKitten2 += 1;
    $max = $posKitten2;
  }

  $output = array();
  for ($idx = 0; $idx <= $max; $idx++)
  {
    if ($idx == $posKitten1 || $idx == $posKitten2)
    {
      array_push($output, $reqKittens -> fetch(PDO::FETCH_ASSOC));
    } else {
      $reqKittens -> fetch();
    }
  }
  return $output;
}

function saveKittens($kitten, $kitten_array, $conn, $kitten_table, $assoc_table)
{
  $updateAssoc = "UPDATE $assoc_table SET ";
  if (min($kitten_array) == $kitten)
  {
    $updateAssoc .= "val1 = val1 + 1";
  } else {
    $updateAssoc .= "val2 = val2 + 1";
  }
  $updateAssoc .= " WHERE(id1=" . min($kitten_array) . " AND id2=" . max($kitten_array) . ");";
  $conn -> query($updateAssoc);

  $updateKitty = $conn -> prepare("UDPATE $kitten_table SET nb_call = nb_call + 1 WHERE id=:kitty;");
  $updateKitty -> bindParam(':kitty', $kitty);
  foreach($kitten_array as $kitty)
  {
    $updateKitty -> execute();
  }
}
?>
