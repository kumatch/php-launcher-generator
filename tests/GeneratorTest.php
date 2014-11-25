<?php

namespace Kumatch\Launcher\Generator\Test;

use Kumatch\Launcher\Generator;
use Kumatch\Launcher\GeneratingParameter;
use Feedtailor\Mocking\MethodInvoker;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    public function providePropertyLauncherGeneratingParams()
    {
        return array(
            array('Path\\To', file_get_contents(__DIR__ . "/results/property_launcher_with_namespace.php")),
            array(null, file_get_contents(__DIR__ . "/results/property_launcher_without_namespace.php"))
        );
    }

    /**
     * @test
     * @dataProvider providePropertyLauncherGeneratingParams
     * @param $namespace
     * @param $result
     */
    public function generatePropertyLauncher($namespace, $result)
    {
        $filename = __DIR__ . "/service.yml";
        $className = "FooLauncher";

        $param = new GeneratingParameter();
        $param
            ->setFilename($filename)
            ->setClassName($className)
            ->setNamespace($namespace);

        $generator = new Generator($param);
        $container = MethodInvoker::create($generator)->invoke("createContainer", array($filename));

        $launcherCode = $generator->generatePropertyLauncher();

        $this->assertEquals(str_replace("__SERIALIZED_CONTAINER__", serialize($container), $result), $launcherCode);
    }

    public function provideMethodLauncherGeneratingParams()
    {
        return array(
            array('Path\\To', file_get_contents(__DIR__ . "/results/method_launcher_with_namespace.php")),
            array(null, file_get_contents(__DIR__ . "/results/method_launcher_without_namespace.php"))
        );
    }

    /**
     * @test
     * @dataProvider provideMethodLauncherGeneratingParams
     * @param $namespace
     * @param $result
     */
    public function generateMethodLauncher($namespace, $result)
    {
        $filename = __DIR__ . "/service.yml";
        $className = "BarLauncher";

        $param = new GeneratingParameter();
        $param
            ->setFilename($filename)
            ->setClassName($className)
            ->setNamespace($namespace);

        $generator = new Generator($param);
        $container = MethodInvoker::create($generator)->invoke("createContainer", array($filename));

        $launcherCode = $generator->generateMethodLauncher();

        $this->assertEquals(str_replace("__SERIALIZED_CONTAINER__", serialize($container), $result), $launcherCode);
    }
}