<?php

require 'mysql-connect.php';
require 'dog.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  handleForm($con);
}

function handleForm($con) {
  // step 1
  $dog = new Dog(
    $_POST['id'],
    $_POST['dogName'],
    $_POST['breed'],
    $_POST['age'],
    $_POST['fixed'],
    $_POST['vac']
  );

  // step 2
  if (!$dog->hasAllValues()) {
    return displayMessage('please enter all fields');
  }

  // step 3
  $q = $dog->getQuery(); // if query isn't working, var_dump($q) is helpful

  // step 4
  $result = $con->query($q);

  if(!$result) {
    return displayMessage($con->error);
  }

  // step 5
  header('Location: list.php');
}

function displayMessage($msg) {
  echo '<p>' . $msg . '</p><a href="addDog.php">Back</a>';
}
