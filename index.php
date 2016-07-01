<?php

require_once __DIR__ . '\bootstrap.php';

$solver = new MarinusJvv\Sudoku\Commandline\Solver();
$solver->start();