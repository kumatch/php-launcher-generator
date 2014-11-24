<?php

namespace Kumatch\Launcher\Generator\Test\Generator;

use Kumatch\Launcher\Generator\ConfigurationLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConfigurationLoaderTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    protected function createLoaderMock()
    {
        return $this->getMockBuilder('Kumatch\Launcher\Generator\ConfigurationLoader')
            ->setMethods(array("loadYaml", "loadPHP", "loadXML", "loadINI"))
            ->getMock();
    }

    public function provideYamlFilename()
    {
        return array(
            array("/path/to/foo.yml"),
            array("/path/to/foo.yaml"),
        );
    }

    /**
     * @test
     * @dataProvider provideYamlFilename
     * @param string $filename
     */
    public function autoloadYaml($filename)
    {
        $container = new ContainerBuilder();

        $loader = $this->createLoaderMock();
        $loader->expects($this->once())->method("loadYaml")
            ->with($this->equalTo($container), $this->equalTo($filename));
        $loader->expects($this->never())->method("loadPHP");
        $loader->expects($this->never())->method("loadXML");
        $loader->expects($this->never())->method("loadINI");
        
        /** @var ConfigurationLoader $loader */
        $loader->load($container, $filename);
    }



    /**
     * @test
     */
    public function autoloadPHP()
    {
        $filename = "/path/to/foo.php";
        $container = new ContainerBuilder();

        $loader = $this->createLoaderMock();
        $loader->expects($this->once())->method("loadPHP")
            ->with($this->equalTo($container), $this->equalTo($filename));
        $loader->expects($this->never())->method("loadYaml");
        $loader->expects($this->never())->method("loadXML");
        $loader->expects($this->never())->method("loadINI");

        /** @var ConfigurationLoader $loader */
        $loader->load($container, $filename);
    }

    /**
     * @test
     */
    public function autoloadXML()
    {
        $filename = "/path/to/foo.xml";
        $container = new ContainerBuilder();

        $loader = $this->createLoaderMock();
        $loader->expects($this->once())->method("loadXML")
            ->with($this->equalTo($container), $this->equalTo($filename));
        $loader->expects($this->never())->method("loadYaml");
        $loader->expects($this->never())->method("loadPHP");
        $loader->expects($this->never())->method("loadINI");

        /** @var ConfigurationLoader $loader */
        $loader->load($container, $filename);
    }

    /**
     * @test
     */
    public function autoloadINI()
    {
        $filename = "/path/to/foo.ini";
        $container = new ContainerBuilder();

        $loader = $this->createLoaderMock();
        $loader->expects($this->once())->method("loadINI")
            ->with($this->equalTo($container), $this->equalTo($filename));
        $loader->expects($this->never())->method("loadYaml");
        $loader->expects($this->never())->method("loadPHP");
        $loader->expects($this->never())->method("loadXML");

        /** @var ConfigurationLoader $loader */
        $loader->load($container, $filename);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throwExceptionIfNotSupportFileType()
    {
        $filename = "/path/to/foo.txt";
        $container = new ContainerBuilder();

        $loader = $this->createLoaderMock();
        $loader->expects($this->never())->method("loadYaml");
        $loader->expects($this->never())->method("loadPHP");
        $loader->expects($this->never())->method("loadXML");
        $loader->expects($this->never())->method("loadINI");

        /** @var ConfigurationLoader $loader */
        $loader->load($container, $filename);
    }
}