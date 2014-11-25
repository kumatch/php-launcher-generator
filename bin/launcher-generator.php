<?php
use Commando\Command;
use Kumatch\Launcher\Generator;
use Kumatch\Launcher\GeneratingParameter;

(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';

$command = new Command();

$command->option()
    ->require()
    ->describe('A services configuration filename.')
    ->must(function($filename) {
        return file_exists($filename);
    });

$command->option('t')
    ->alias('type')->alias('launcher-type')
    ->describe('A launcher type (property or method), default "property".')
    ->default('property')
    ->must(function($type) {
        $type = strtolower($type);
        return ($type === "property" || $type === "method");
    });


$command->option('c')
    ->alias('class')
    ->describe('A class name of launcher, default "Launcher"')
    ->default('Launcher')
    ->must(function($className) {
        return (preg_match('/^[a-z0-9_]+$/i', $className));
    });

$command->option('n')
    ->alias('namespace')
    ->describe('A namespace of class, default none (no namespace).')
    ->must(function($namespace) {
        if (is_null($namespace) || $namespace === "") {
            return true;
        }
        return (preg_match('/^[a-z0-9_\\\\]+$/i', $namespace));
    });

$filename = is_link($command[0]) ? realpath(readlink($command[0])) :  realpath($command[0]);

$param = new GeneratingParameter();
$param
    ->setFilename($filename)
    ->setClassName($command['c'])
    ->setNamespace($command['n']);
$generator = new Generator($param);

switch (strtolower($command['t'])) {
    case "property":
        echo $generator->generatePropertyLauncher();
        break;
    case "method":
        echo $generator->generateMethodLauncher();
        break;
    default:
        throw new \Exception();
}
