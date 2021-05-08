<?php

require __DIR__ . '/vendor/autoload.php';

use SpaceX\App\Application;

if (!isset($argv) || !is_array($argv)) {
    throw new RuntimeException('Script is intended for command line use');
}

(new Application())->run($argv);
