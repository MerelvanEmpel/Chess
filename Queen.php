<?php

class Queen {
  private $locationX;
  private $locationY;

  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

  public function __set($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }

    return $this;
  }

  public function addDangerZone(Board &$board) {
    $board->dangerZone = array();
    $boardDimensionX = $board->dimensionX;
    $boardDimensionY = $board->dimensionY;

    // If  we are missing any important variables,stop.
    if (empty($boardDimensionX)
      || empty($boardDimensionY)
      || (!is_int($this->locationX))
      || ($this->locationX < 0)
      || (!is_int($this->locationY))
      || ($this->locationY < 0)) {
      return $board->dangerZone;
    }

    // Loop over the squares on the board and see if they are in the danger zone.
    // If so, put the coordinates in the danger_zone array.
    for ($x=0; $x <= $board->dimensionX; $x++) {
      // Add to the vertical line of the queen as a danger zone.
      $this->putCoordinateInDangerZone($x, $this->locationY, $board);
      for ($y=0; $y <= $board->dimensionY; $y++) {
        // Add to the horizontal line of the queen as a danger zone.
        $this->putCoordinateInDangerZone($this->locationX, $y, $board);
        // If this coordinate is not in a diagonal line with the queen, continue.
        if (!$this->isInDiagonalLine($x, $y)) {
          continue(1);
        }

        $this->putCoordinateInDangerZone($x, $y, $board);
      }
    }
  }

  function putCoordinateInDangerZone($x, $y, $board) {
    // If this coordinate is already in the dangerZone array, return.
    if (in_array(array($x, $y), $board->dangerZone)) {
      return;
    }
    array_push($board->dangerZone, array($x, $y));
  }

  function isInDangerZone($board) {
    if (empty($board->dangerZone)) {
      return;
    }
    if (in_array(array($this->locationX, $this->locationY), $board->dangerZone)) {
      return TRUE;
    }
    return FALSE;
  }

  function isInDiagonalLine($x, $y) {
    // If  we are missing any important variables, return FALSE.
    if ((!is_int($x))
      || ($x < 0)
      || (!is_int($y))
      || ($y < 0)
      || (!is_int($this->locationX))
      || ($this->locationX < 0)
      || (!is_int($this->locationY))
      || ($this->locationY < 0)) {
      return FALSE;
    }

    If (($x - $this->locationX) == ($y - $this->locationY)) {
      return TRUE;
    }

    return FALSE;
  }

}

?>

