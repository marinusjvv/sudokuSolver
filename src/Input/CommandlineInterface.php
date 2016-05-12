<?php

namespace MarinusJvv\Sudoku\Input;

class CommandlineInterface
{
    public function getInput($prompt = '')
    {
        if (!empty($prompt)) {
            $this->sendOutput($prompt);
        }
        return trim(fgets(STDIN));
    }

    public function sendOutput($output, $newLine = false)
    {
        $output .= $newLine === true ? PHP_EOL : '';
        fwrite(STDOUT, $output);
    }
}
