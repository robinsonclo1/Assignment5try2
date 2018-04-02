<?php
require 'mysql-connect.php';

$id = $_GET['id'];

$q = 'delete from dogs where dog_id =' . $id;
$result = $con->query($q);

if ($result) {
  header('Location: list.php');
} else {
  echo $con->error;
}

?>
