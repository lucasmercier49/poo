<?php
include "Player.php";

$Dbo = new Player("Dbo", [], 10000, []);
$Enzo = new Player("Enzo", [], 10000, []);
$Paris = new City("Paris", 500, 200);
$Angers = new City("Angers", 200, 200);


$Dbo->payPlayer($Enzo, 50000);
$Enzo->buy($Paris);
