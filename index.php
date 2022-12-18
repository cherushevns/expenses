<?php
use App\Framework\AppBuilder;

require __DIR__ . '/vendor/autoload.php';

const DIR_ROOT = __DIR__;

AppBuilder::buildHttpApp()->run();


