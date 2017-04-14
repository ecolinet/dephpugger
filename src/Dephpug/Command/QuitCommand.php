<?php

namespace Dephpug\Command;

use Dephpug\Exception\ExitProgram;
use Dephpug\Readline;

class QuitCommand extends \Dephpug\Command
{
    public function getName()
    {
        return 'Quit';
    }

    public function getShortDescription()
    {
        return 'Quit the debugger';
    }

    public function getDescription()
    {
        return 'This command ask if you want to close the debugger. The request/script will continue when the debugger stop.';
    }

    public function getAlias()
    {
        return 'q / quit';
    }

    public function getRegexp()
    {
        return '/^q(?:uit)?$/i';
    }

    public function exec()
    {
        $readline = new Readline();
        $response = $readline->scan('Are you sure? (y/n): ');
        if ('y' === strtolower($response)) {
            throw new ExitProgram('Closing dephpugger');
        }
    }
}
