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
  public function setDangerZone(Array $dangerZone) {
    $this->dangerZone = $dangerZone;
  }

  /**
   * Adds the given coordinate to the given dangerZone.
   *
   * @param $x
   * @param $y
   * @param $dangerZone
   */
  public function putCoordinateInDangerZone($x, $y) {
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

