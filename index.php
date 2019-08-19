<?php

/*
 * This script will calculate the amount of ways in which 7 queens that can be
 * on one chess board without being able to overtake each other.
 */

// Lazy loading of classes.
spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

$board = new Board();

// The board is 7x7.
$board->setDimensionX(7);
$board->setDimensionY(7);
$queensArray = array();

// Attempt to put 7 queens on the board.
for ($i=0; $i<7; $i++) {
  array_push($queensArray, putQueenSafeOnBoard($board));
}

// Print the coordinates of all queens to the screen.
print '<BR>';
print 'Queen coordinates:';
foreach($queensArray as $coordinates) {
  print '<BR>';
  print_r($coordinates);
}

/**
 * Puts a queen on the board, given the board with its current dangerZones.
 *
 * @param \Board $board
 *
 * @return array
 */
function putQueenSafeOnBoard(Board &$board) {
  $queensCoordinates = array();
  // Create a new queen and try to put her on the board somewhere.
  // If it is not safe, move her and check if it's safe untill a safe spot is found.
  $queen = new Queen();
  for ($x=0; $x <= $board->getDimensionX()-1; $x++) {
    for ($y=0; $y <= $board->getDimensionY()-1; $y++) {
      $queen->setLocationX($x);
      $queen->setLocationY($y);
      // If the queen is not in the dangerZone, add her dangerZone to the board,
      // and return her coordinates.
      if (!$queen->isInDangerZone($board)) {
        // Get this queen's dangerZone.
        $queen->addDangerZoneToBoard($board);
        // Add this coordinate to the array with queens on them.
        $queensCoordinates = array($x, $y);
        // return the coordinates of this queen.
        return $queensCoordinates;
      }
    }
  }
  // If it is safe, add her dangerZone to the dangerZone that is already there and
  // repeat untill we have the required number of queens, or stop if we have exhausted all options.

  return $queensCoordinates;
}

?>

