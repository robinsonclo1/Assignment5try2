<?php
/**
 * Our dog class, which does two things for us:
 *  1. It helps map data in PHP to our game table in MySQL simply by existing
 *     as as datatype with properties that match the columns.
 *  2. It has some validation and helper methods to assist with saving data
 *     to MySQL.
 */
class Dog {

  // properties
  public $id;
  public $name;
  public $breed_id;
  public $age;
  public $is_fixed = false;
  public $is_vaccinated = false;

  /**
   * Constructors are always named __construct, starting with two underscores.
   * Here we've added six parameters to initialize the six properties on our
   * object.
   */
  public function __construct($dogId = null, $dogName = '', $breedID = '',
    $age = '', $isFixed = false, $isVaccinated = false) {
    $this->id = $dogId;
    $this->name = $dogName;
    $this->breed_id = $breedID;
    $this->age = $age;
    $this->is_fixed = $isFixed;
    $this->is_vaccinated = $isVaccinated;
  }

  /**
   * This function will tell us if we have everything we need to save a game
   * to the database or not.
   */
  public function hasAllValues() {
    return !empty($this->name);
  }

  /**
   * This function is a simple test of whether or not the year is numeric on
   * this game object.
   */
  public function ageIsNumeric() {
    return is_numeric($this->age);
  }

  /**
   * This function will generate the SQL necessary to save the game to the
   * database. Depending on whether the dog has an ID, it will return either
   * an update (yes) or an insert (no) statement.
   */
  public function getQuery() {
    // note the curly braces where we call a method inside the double quotes
    if ($this->haveDogId()) {
      return "update dogs
        set dog_name = '$this->name',
        breed_id = '$this->breed_id',
        age = '$this->age',
        is_fixed = {$this->fixedBoolToInt()},
        is_vaccinated = {$this->vacBoolToInt()},
        where dog_id = $this->id";
    } else {
      return "insert into dogs (dog_name, breed_id, age, is_fixed, is_vaccinated)
        values ('$this->name', '$this->breed_id', '$this->age', '{$this->fixedBoolToInt()}',
        '{$this->vacBoolToInt()}')";
    }
  }

  /**
   * A simple function to determine whether we have a dog ID or not on this
   * game object.
   */
  private function haveDogId() {
    return isset($this->id) && is_numeric($this->id);
  }

  /**
   * In PHP, we are using true or false for completed, but when we save to the
   * database, we need 1 or 0. This function does that conversion for us.
   */
  private function fixedBoolToInt() {
    return $this->is_fixed ? 1 : 0;
  }

 private function vacBoolToInt() {
   return $this->is_vaccinated ? 1 : 0;
 }
}
