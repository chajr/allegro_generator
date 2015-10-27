<?php

namespace Generator\Mod;

use Slim\Slim;

abstract class Base
{
    abstract public function execute(Slim $app);
}
