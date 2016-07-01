<?php

namespace MarinusJvv\Sudoku\Commandline;

use MarinusJvv\Sudoku\Display\BoardVisualizer;
use MarinusJvv\Sudoku\Exceptions\InvalidFileLocationException;
use MarinusJvv\Sudoku\Solver as ParentSolver;

/*
D:\xampp\htdocs\sudokuSolver\tests\data\easyPuzzle.csv
 */

class Solver extends ParentSolver
{
    /**
     * @var CommandlineInterface
     */
    protected $interface;

    public function __construct()
    {
        parent::__construct();
        $this->interface = new CommandlineInterface();
    }

    public function start()
    {
        $this->interface->displayOutput('Welcome to Suduko solver');
        $this->interface->displayOutput('Type "help" anytime for a list of commands');
        $this->interface->displayOutput('Would you like to start a new puzzle or continue an old one? ', false);
        $this->awaitInput();
    }

    protected function awaitInput()
    {
        while (true) {
            $command = $this->interface->getUserInput();
            $this->processInput($command);
        }
    }

    protected function processInput($command)
    {
        switch (strtolower($command)) {
            case 'help':
                $this->displayHelpOptions();
                return;
                break;
            case 'new':
            case 'n':
                $this->startNewPuzzle();
                return;
                break;
            case 'show':
                $this->showPuzzle();
                return;
                break;
        }
        if (stripos($command, 'input') !== false) {
            $this->processDataInput($command);
            return;
        }
        if (stripos($command, 'solve') !== false) {
            $this->doSolve($command);
            return;
        }
        $this->interface->displayOutput('Input not recognised');
        $this->displayHelpOptions();
    }

    private function displayHelpOptions()
    {
        $this->interface->displayOutput('Commands are as follows: ');
        $this->interface->displayOutput('NEW: build new puzzle');
        $this->interface->displayOutput('CONTINUE: continue existing puzzle');
        $this->interface->displayOutput('LOAD <puzzle name>: loads an existing puzzle from memory');
        $this->interface->displayOutput('INPUT <row number> <column number> <value>: Manually loads a value into the puzzle');
        $this->interface->displayOutput('INPUT <file location>: Loads a puzzle from a CSV file');
        $this->interface->displayOutput('HINT: Get one number from the solver');
        $this->interface->displayOutput('SOLVE: Solve entire puzzle');
        $this->interface->displayOutput('SOLVE <number>: Solve only a certain amount of values');
        $this->interface->displayOutput('SHOW: Show the current board');
    }

    private function startNewPuzzle()
    {
        $this->interface->displayOutput('How would you like to input your data?');
        $this->interface->displayOutput('INPUT <row number> <column number> <value>: Manually loads a value into the puzzle');
        $this->interface->displayOutput('INPUT <file location>: Loads a puzzle from a CSV file');
    }

    private function processDataInput($command)
    {
        $parts = explode(' ', $command);
        if (count($parts) !== 2 && count($parts) !== 4) {
            $this->interface->displayOutput('Input not recognised');
            $this->interface->displayOutput('INPUT <row number> <column number> <value>: Manually loads a value into the puzzle');
            $this->interface->displayOutput('INPUT <file location>: Loads a puzzle from a CSV file');
            return;
        }
        if (count($parts) === 2) {
            try {
                $this->addData($parts[1]);
            } catch (InvalidFileLocationException $e) {
                $this->interface->displayOutput('Invalid file');
                return;
            }
        } else {
            try {
                $this->addValue((int)$parts[1], (int)$parts[2], (int)$parts[3]);
            } catch (\InvalidArgumentException $e) {
                $this->interface->displayOutput($e->getMessage());
                return;
            }

        }
        $this->interface->displayOutput('Data saved');
    }

    private function doSolve($command)
    {
        $parts = explode(' ', $command);
        $solves = count($parts) === 2 ? (int)$parts[1] : false;
        $this->solvePuzzle($solves);
        $this->showPuzzle();
    }

    private function showPuzzle()
    {
        $output = BoardVisualizer::getBoardDisplayString($this->getBoard());
        $this->interface->displayOutput($output);
    }
}
