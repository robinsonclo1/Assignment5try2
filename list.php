<?php
include 'header.php';
require 'mysql-connect.php';
include 'dog.php';

$q = 'select * from dogs
  left join breeds using(breed_id)
  order by dog_name;';
$result = $con->query($q);
?>

<!DOCTYPE html>
<html lang="en">
  <body>
    <div class="container">

      <div class="main jumbotron">
        <h1>Dogs in the Kennel</h1>
        <table class="dogTable">
          <tr>
            <th>Name</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Vaccinated</th>
            <th>Fixed</th>
            <th>Action</th>
          </tr>

        <?php foreach($result as $row): ?>
          <tr>
            <td><?=$row['dog_name']?></td>
            <td><?=$row['breed_name']?></td>
            <td><?=$row['age']?></td>
            <td><?=$row['is_vaccinated'] ? 'Yes' : 'No'?></td>
            <td><?=$row['is_fixed'] ? 'Yes' : 'No'?></td>
            <td>

              <a href="addDog.php?id=<?=$row['dog_id']?>" class="btn btn-primary">Edit</a>
              &nbsp;
              <a href="delete.php?id=<?=$row['dog_id']?>" class="btn btn-danger btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </table>
      </div>

    </div> <!-- /container -->
  </body>
</html>
