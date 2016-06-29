<?php

namespace MarinusJvv\Sudoku\Commandline;

use MarinusJvv\Sudoku\Solver as ParentSolver;

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
                break;
            case 'new':
                $this->startNewPuzzle();
                break;
        }
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
    }

    private function startNewPuzzle()
    {
        $this->interface->displayOutput('Commands are as follows: ');

    }
}
