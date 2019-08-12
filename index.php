<?php

/*
 * This script will calculate the amount of ways in which 7 queens that can be
 * on one chess board without being able to overtake each other.
 */

spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

$board = new Board();

// The board is 7x7, the values range from 0 till 6.
$board->dimensionX = 6;
$board->dimensionY = 6;
$queensArray = array();

for ($i=0; $i<=7; $i++) {
  array_push($queensArray, putQueenSafeOnBoard($board));
}

function putQueenSafeOnBoard(Board $board) {
  $queensCoordinates = array();
  // Create a new queen and try to put her on the board somewhere.
  // If it is not safe, move her and check if it's safe untill a safe spot is found.
  $queen = new Queen();
  for ($x=0; $x <= $board->dimensionX; $x++) {
    for ($y=0; $y <= $board->dimensionY; $y++) {
      $queen->locationX = $x;
      $queen->locationY = $y;
      // If the queen is not in the dangerZone, add her dangerZone to the board,
      // and return her coordinates.
      if (!$queen->isInDangerZone($board)) {
        // Add this queen's dangerZone to the board
        $queen->addDangerZone($board);
        // Add this coordinate to the array with queens on them
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

function testDiagonalLineFunction(Queen $queen) {
  // Put the queen on 1,1
  $queen->locationX = 1;
  $queen->locationY = 1;

  // Test the diagonal coordinates function for diagonal and non-diagonal coordinates
  // below and above the queen.
  $testCoordinate = array(0,0);
  print('<BR>');
  // Expected result: TRUE.
  print($queen->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'TRUE' : 'FALSE');
  $testCoordinate = array(0,2);
  print('<BR>');
  // Expected result: FALSE.
  print($queen->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'TRUE' : 'FALSE');
  $testCoordinate = array(2,0);
  print('<BR>');
  // Expected result: FALSE.
  print($queen->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'TRUE' : 'FALSE');
  $testCoordinate = array(2,2);
  print('<BR>');
  // Expected result: TRUE.
  print($queen->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'TRUE' : 'FALSE');

  // Test impossible coordinates.
  $testCoordinate = array(-1,-1);
  print('<BR>');
  // Expected result: FALSE.
  print($queen->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'TRUE' : 'FALSE');
  $testCoordinate = array(-1,1);
  print('<BR>');
  // Expected result: FALSE.
  print($queen->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'TRUE' : 'FALSE');
  $testCoordinate = array(-7,7);
  print('<BR>');
  // Expected result: FALSE.
  print($queen->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'TRUE' : 'FALSE');
  $testCoordinate = array(-7,-7);
  print('<BR>');
  // Expected result: FALSE.
  print($queen->isInDiagonalLine($testCoordinate[0],$testCoordinate[1]) ? 'TRUE' : 'FALSE');
}

?>

