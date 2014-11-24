<?php
namespace Kumatch\Launcher;

use Kumatch\Launcher\Generator\ConfigurationLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Twig_Environment;
use Twig_Loader_Filesystem;

use Kumatch\Launcher;

/**
 * Class Generator
 */
class Generator
{
    /** @var  GeneratingParameter */
    protected $param;
    /** @var array */
    protected $templates = array(
        'property' => 'PropertyLauncher.php.tmpl',
        'method'   => 'MethodLauncher.php.tmpl'
    );

    /**
     * @param GeneratingParameter $param
     */
    public function __construct(GeneratingParameter $param)
    {
        $this->param = $param;
    }

    /**
     * @return string
     */
    public function generatePropertyLauncher()
    {
        return $this->renderLauncherClass("property");
    }

    /**
     * @return string
     */
    public function generateMethodLauncher()
    {
        return $this->renderLauncherClass("method");
    }


    /**
     * @param string $type
     * @throws \Exception
     * @return string
     */
    protected function renderLauncherClass($type)
    {
        if (!isset($this->templates[$type])) {
            throw new \Exception();
        }

        $container = $this->createContainer($this->param->getFilename());
        $values = array(
            "id" => sha1($this->param->getClassName()),
            "class" => $this->param->getClassName(),
            "namespace" => $this->param->getNamespace(),
            "container" => serialize($container),
            "services" => $this->normalizeServices($container)
        );

        $renderer = $this->createRenderer();

        return $renderer->render($this->templates[$type], $values);
    }



    /**
     * @param $filename
     * @return ContainerBuilder
     */
    protected function createContainer($filename)
    {
        $container = new ContainerBuilder();
        $loader = new ConfigurationLoader();

        return $loader->load($container, $filename);
    }

    /**
     * @return Twig_Environment
     */
    protected function createRenderer()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . "/Template");
        $twig = new Twig_Environment($loader);

        return $twig;
    }


    /**
     * @param ContainerBuilder $container
     * @return array
     */
    protected function normalizeServices(ContainerBuilder $container)
    {
        $services = array();

        foreach ($container->getDefinitions() as $id => $definition) {
            $name = $container::camelize($id);
            $className = $definition->getClass();
            if (substr($className, 0, 1) !== '\\') {
                $className = '\\' . $className;
            }

            $services[$name] = $className;
        }

        return $services;
    }
}