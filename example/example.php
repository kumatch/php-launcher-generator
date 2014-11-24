<?php
use Path\To\MyApp\MyLauncher;

require_once "../vendor/autoload.php";
require_once "./MyLauncher.php";
require_once "./FooBar.php";

$launcher = new MyLauncher();

var_dump($launcher->launchFoobar());