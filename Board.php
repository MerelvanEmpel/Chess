<?php

class Board {

  private $dimensionX;
  private $dimensionY;
  private $dangerZone = Array();

  /**
   * @return mixed
   */
  public function getDimensionX() {
    return $this->dimensionX;
  }

  /**
   * @return mixed
   */
  public function getDimensionY() {
    return $this->dimensionY;
  }

  /**
   * @return mixed
   */
  public function getDangerZone() {
    return $this->dangerZone;
  }

  /**
   * @param mixed $dimensionX
   */
  public function setDimensionX($dimensionX) {
    // If the dimension is not an integer or is an integer smaller then 0,
    // throw an exeption.
    if (!is_int($dimensionX) || $dimensionX < 0) {
      throw new InvalidArgumentException();
    }
    $this->dimensionX = $dimensionX;
  }

  /**
   * @param mixed $dimensionY
   */
  public function setDimensionY($dimensionY) {
    // If the dimension is not an integer or is an integer smaller then 0,
    // throw an exeption.
    if (!is_int($dimensionY) || $dimensionY < 0) {
      throw new InvalidArgumentException();
    }
    $this->dimensionY = $dimensionY;
  }

  /**
   * @param mixed $dangerZone
   */
  private function setDangerZone(Array $dangerZone) {
    $this->dangerZone = $dangerZone;
  }

  public function addQueen(Queen $queen) {

  }

  /**
   * Checks if this queen is in the danger zone of the board.
   *
   * @param $board
   *
   * @return bool
   */
  public function isInDangerZone(Queen $queen) {
    if (empty($this->getDangerZone())) {
      return false;
    }
    if (in_array(array($queen->getLocationX(), $queen->getLocationY()), $this->getDangerZone())) {
      return true;
    }
    return false;
  }

  /**
   * Updates the danger zone of this board.
   *
   * @param \Board $board
   *
   * @return array
   */
  public function addQueenDangerZone(Queen $queen) {
    $queenDangerZoneMethod = $queen->getDangerZoneMethod();
    $boardDimensionX = $this->getDimensionX();
    $boardDimensionY = $this->getDimensionY();

    // If  we are missing any important variables,stop.
    if (empty($boardDimensionX)) {
      throw new UnexpectedValueException('Board dimensionX not set.');
    }
    if (empty($boardDimensionY)) {
      throw new UnexpectedValueException('Board dimensionY not set.');
    }

    // Set the danger zone of the queen.
    $queenDangerZoneMethod($boardDimensionX, $boardDimensionY);

    // Add the dangerzone of the queen to the dangerzone of this board.
    $this->addDangerZone($queen->getDangerZone());
  }

private function addDangerZone(Array $dangerZone) {
  foreach ($dangerZone as $coordinate) {
    $this->putCoordinateInDangerZone($coordinate[0], $coordinate[1]);
  }
}

  /**
   * Adds the given coordinate to the given dangerZone.
   *
   * @param $x
   * @param $y
   */
  private function putCoordinateInDangerZone($x, $y) {
    $dangerZone = $this->getDangerZone();

    // If this coordinate is already in the dangerZone array, return.
    if (in_array(array($x, $y), $dangerZone)) {
      return;
    }
    array_push($dangerZone, array($x, $y));

    $this->setDangerZone($dangerZone);
  }

}

?>

