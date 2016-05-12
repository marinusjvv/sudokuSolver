<?php

require_once __DIR__ . '\bootstrap.php';

$cli = new MarinusJvv\Sudoku\Input\CommandlineInterface();

$cli->sendOutput('Welcome to Suduko solver', true);
$cli->sendOutput('Type "help" anytime for a list of commands', true);
$cli->getInput('Would you like to start a new puzzle or continue an old one? ');