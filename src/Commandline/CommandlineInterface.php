<?php

namespace MarinusJvv\Sudoku\Commandline;

class CommandlineInterface
{
    /**
     * @param string $prompt
     * @return string
     */
    public function getUserInput($prompt = '')
    {
        if (!empty($prompt)) {
            $this->displayOutput($prompt);
        }
        return trim(fgets(STDIN));
    }

    public function displayOutput($output, $newLine = true)
    {
        $output .= $newLine === true ? PHP_EOL : '';
        fwrite(STDOUT, $output);
    }
}
