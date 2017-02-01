<?php
  session_start();
  header('Content-type: application/json');
  echo json_encode(array("test"=>"chat"));
?>
