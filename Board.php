<?php

class Board {

  private $dimensionX;
  private $dimensionY;
  public $dangerZone;

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
    $this->dimensionX = $dimensionX;
  }

  /**
   * @param mixed $dimensionY
   */
  public function setDimensionY($dimensionY) {
    $this->dimensionY = $dimensionY;
  }

  /**
   * @param mixed $dangerZone
   */
  public function setDangerZone($dangerZone) {
    $this->dangerZone = $dangerZone;
  }
}

?>

