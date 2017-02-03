<?php
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

  //$updateKitty = $conn -> prepare("UDPATE $kitten_table SET nb_call = nb_call + 1 WHERE id=:kitty;");
  //$updateKitty -> bindParam(':kitty', $kitty);
  //foreach($kitten_array as $kitty)
  //{
  //  $updateKitty -> execute();
  //}
}
?>
