<?php

namespace Dephpug\Interfaces;

interface iCommand
{
    public function getName();
    public function getShortDescription();
    public function getDescription();
    public function getRegexp();
}
