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
    // If the location is not an integer or is an integer smaller then 0,
    // throw an exeption.
    if (!is_int($locationX) || $locationX < 0) {
      throw new InvalidArgumentException();
    }
    $this->locationX = $locationX;
  }

  /**
   * @param mixed $locationY
   */
  public function setLocationY($locationY) {
    // If the location is not an integer or is an integer smaller then 0,
    // throw an exeption.
    if (!is_int($locationY) || $locationY < 0) {
      throw new InvalidArgumentException();
    }
    $this->locationY = $locationY;
  }

  /**
   * Adds a danger zone to the dangerzone of the given board.
   *
   * @param \Board $board
   *
   * @return array
   */
  public function addDangerZoneToBoard(Board $board) {
    $boardDimensionX = $board->getDimensionX();
    $boardDimensionY = $board->getDimensionY();

    // If  we are missing any important variables,stop.
    if (empty($boardDimensionX)) {
      throw new UnexpectedValueException('Board dimensionX not set.');
    }
    if (empty($boardDimensionY)) {
      throw new UnexpectedValueException('Board dimensionY not set.');
    }

    // Loop over the squares on the board and see if they are in the danger zone.
    // If so, put the coordinates in the danger_zone array.
    for ($x=0; $x <= $boardDimensionX-1; $x++) {
      // Add to the vertical line of the queen as a danger zone.
      $board->putCoordinateInDangerZone($x, $this->locationY);
      for ($y=0; $y <= $boardDimensionY-1; $y++) {
        // Add to the horizontal line of the queen as a danger zone.
        $board->putCoordinateInDangerZone($this->locationX, $y);
        // If this coordinate is not in a diagonal line with the queen, continue.
        if (!$this->isInDiagonalLine($x, $y)) {
          continue 1;
        }

        $board->putCoordinateInDangerZone($x, $y);
      }
    }
  }

  /**
   * Checks if this queen is in the danger zone of the board.
   *
   * @param $board
   *
   * @return bool
   */
  public function isInDangerZone($board) {
    if (empty($board->getDangerZone())) {
      return false;
    }
    if (in_array(array($this->locationX, $this->locationY), $board->getDangerZone())) {
      return true;
    }
    return false;
  }

  /**
   * Checks if the given coordinate is in a diagonal line with this queen.
   *
   * @param $x
   * @param $y
   *
   * @return bool
   */
  public function isInDiagonalLine($x, $y) {
    // If  x or y are invalid, return false.
    if ((!is_int($x))
      || ($x < 0)
      || (!is_int($y))
      || ($y < 0)) {
      return false;
    }

    // Turn the numbers to absolutes to ensure both ways of the diagonal are included.
    If (abs(($x - $this->locationX)) == (abs($y - $this->locationY))) {
      return true;
    }

    return false;
  }


  /**
   * Test function to determine if the diagonal function is working properly.
   */
  public function testDiagonalLineFunction() {
    // Put the queen on 1,1
    $this->setLocationX(1);
    $this->setLocationY(1);

    // Test the diagonal coordinates function for diagonal and non-diagonal coordinates
    // below and above the queen.
    $testCoordinate = array(0,0);
    print '<BR>';
    // Expected result: true.
    print $this->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'true' : 'false';
    $testCoordinate = array(0,2);
    print '<BR>';
    // Expected result: true.
    print $this->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'true' : 'false';
    $testCoordinate = array(2,0);
    print '<BR>';
    // Expected result: true.
    print $this->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'true' : 'false';
    $testCoordinate = array(2,2);
    print '<BR>';
    // Expected result: true.
    print $this->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'true' : 'false';
    $testCoordinate = array(3,2);
    print '<BR>';
    // Expected result: false.
    print $this->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'true' : 'false';

    // Test impossible coordinates.
    $testCoordinate = array(-1,-1);
    print '<BR>';
    // Expected result: false.
    print $this->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'true' : 'false';
    $testCoordinate = array(-1,1);
    print '<BR>';
    // Expected result: false.
    print $this->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'true' : 'false';
    $testCoordinate = array(-7,7);
    print '<BR>';
    // Expected result: false.
    print $this->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'true' : 'false';
    $testCoordinate = array(-7,-7);
    print '<BR>';
    // Expected result: false.
    print $this->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'true' : 'false';
  }

}

?>

