<?php
include 'header.php';
require 'mysql-connect.php';
require 'dog.php';

$id = $_GET['id'] ?? null;

$breed = $con->query("Select * from Breeds");

if ($id) {
  $q = 'select * from dogs where dog_id = ' . $id;

  $result = $con->query($q);
  $row = $result->fetch_assoc();
  $dog = new Dog($row['dog_id'], $row['dog_name'], $row['breed_id'],
    $row['age'], $row['is_fixed'], $row['is_vaccinated']);
} else {
  $dog = new Dog();
}
?>

<!DOCTYPE html>
<html>
  <body>
    <div class="container">

      <div class="jumbotron">
        <h1>Add Dog to the Kennel</h1>
        <form class="form-box" action="form-handler.php" method="post">

          <input type="hidden" value="<?=$dog->id?>" name="id">

          <label>
            Name
            <input type="text" name="dogName" value="<?=$dog->name?>" required/>
          </label>

          <label>
            Breed
            <select class="from-dropdown" name="breed">
              <option></option>
              <!--
              To build our dropdowns we loop over the result rows and compare each
              row's developer_id with the developerId of the game we are editing.
              If there's a match, we add the word "selected" to the option tag so
              it will be selected in the dropdown.
              -->
              <?php foreach($breed as $row): ?>
                <option value="<?=$row['breed_id']?>"
                  <?=$dog->breed_id === $row['breed_id'] ? 'selected' : ''?>>
                  <?=$row['breed_name']?>
                </option>
              <?php endforeach; ?>
            </select>
          </label>

    		  <label>
            Age (Years)
    		    <input name="age" type="number" min="0" max="30" value="<?=$dog->age?>" required/>
          </label>

         	<label>Vaccinated?
              <input type="checkbox" name="vac" <?=$dog->is_vaccinated ? 'checked' : ''?>/>Yes
          </label>

          <label>Fixed?
              <input type="checkbox" name="fixed" <?=$dog->is_fixed ? 'checked' : ''?>/>Yes
          </label>

    		  <input class="btn btn-primary" type="submit"></input>
    		  <input class="btn btn-danger" type="reset"></input>
  	    </form>
      </div>

    </div> <!-- /container -->
  </body>
</html>
