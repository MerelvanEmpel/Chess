<?php

class Queen {
  private $locationX;
  private $locationY;

  /**
   * @return mixed
   */
  public function getLocationX() {
    return $this->locationX;
  }

  /**
   * @return mixed
   */
  public function getLocationY() {
    return $this->locationY;
  }

  /**
   * @param mixed $locationX
   */
  public function setLocationX($locationX) {
    $this->locationX = $locationX;
  }

  /**
   * @param mixed $locationY
   */
  public function setLocationY($locationY) {
    $this->locationY = $locationY;
  }

  /**
   * Adds a danger zone to the dangerzone of the given board and returns it.
   *
   * @param \Board $board
   *
   * @return array
   */
  public function addDangerZoneToBoard(Board &$board) {
    $dangerZone = $board->getDangerZone();
    if($dangerZone == NULL) {
      $dangerZone = array();
    }

    $boardDimensionX = $board->getDimensionX();
    $boardDimensionY = $board->getDimensionY();

    // If  we are missing any important variables,stop.
    if (empty($boardDimensionX)
      || empty($boardDimensionY)
      || (!is_int($this->locationX))
      || ($this->locationX < 0)
      || (!is_int($this->locationY))
      || ($this->locationY < 0)) {
      return $dangerZone;
    }

    // Loop over the squares on the board and see if they are in the danger zone.
    // If so, put the coordinates in the danger_zone array.
    for ($x=0; $x <= $boardDimensionX; $x++) {
      // Add to the vertical line of the queen as a danger zone.
      $this->putCoordinateInDangerZone($x, $this->locationY, $dangerZone);
      for ($y=0; $y <= $boardDimensionY; $y++) {
        // Add to the horizontal line of the queen as a danger zone.
        $this->putCoordinateInDangerZone($this->locationX, $y, $dangerZone);
        // If this coordinate is not in a diagonal line with the queen, continue.
        if (!$this->isInDiagonalLine($x, $y)) {
          continue(1);
        }

        $this->putCoordinateInDangerZone($x, $y, $dangerZone);
      }
    }
    return $dangerZone;
  }

  /**
   * Adds the given coordinate to the given dangerZone.
   *
   * @param $x
   * @param $y
   * @param $dangerZone
   */
  function putCoordinateInDangerZone($x, $y, &$dangerZone) {
    // If this coordinate is already in the dangerZone array, return.
    if (in_array(array($x, $y), $dangerZone)) {
      return;
    }
    array_push($dangerZone, array($x, $y));
  }

  /**
   * Checks if this queen is in the danger zone of the board.
   *
   * @param $board
   *
   * @return bool
   */
  function isInDangerZone($board) {
    if (empty($board->getDangerZone())) {
      return FALSE;
    }
    if (in_array(array($this->locationX, $this->locationY), $board->getDangerZone())) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Checks if the given coordinate is in a diagonal line with this queen.
   *
   * @param $x
   * @param $y
   *
   * @return bool
   */
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

    // Turn the numbers to absolutes to ensure both ways of the diagonal are included.
    If (abs(($x - $this->locationX)) == (abs($y - $this->locationY))) {
      return TRUE;
    }

    return FALSE;
  }

}

?>

