<?php
namespace Kumatch\Launcher\Generator;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\IniFileLoader;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;


/**
 * ConfigurationLoader
 */
class ConfigurationLoader
{

    /**
     * @param ContainerBuilder $container
     * @param string $filename
     * @return ContainerBuilder
     */
    public function load(ContainerBuilder $container, $filename)
    {
        $filename = strtolower($filename);

        if (preg_match('/\.yml$/', $filename) || preg_match('/\.yaml$/', $filename)) {
            return $this->loadYaml($container, $filename);
        } else if (preg_match('/\.php$/', $filename)) {
            return $this->loadPHP($container, $filename);
        } else if (preg_match('/\.xml$/', $filename)) {
            return $this->loadXML($container, $filename);
        } else if (preg_match('/\.ini$/', $filename)) {
            return $this->loadINI($container, $filename);
        } else {
            throw new \InvalidArgumentException("not support file type: " . $filename);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param $filename
     * @return ContainerBuilder
     */
    public function loadYaml(ContainerBuilder $container, $filename)
    {
        $loader = new YamlFileLoader($container, new FileLocator());
        $loader->load($filename);

        return $container;
    }

    /**
     * @param ContainerBuilder $container
     * @param $filename
     * @return ContainerBuilder
     */
    public function loadPHP(ContainerBuilder $container, $filename)
    {
        $loader = new PhpFileLoader($container, new FileLocator());
        $loader->load($filename);

        return $container;
    }

    /**
     * @param ContainerBuilder $container
     * @param $filename
     * @return ContainerBuilder
     */
    public function loadXML(ContainerBuilder $container, $filename)
    {
        $loader = new XmlFileLoader($container, new FileLocator());
        $loader->load($filename);

        return $container;
    }

    /**
     * @param ContainerBuilder $container
     * @param $filename
     * @return ContainerBuilder
     */
    public function loadINI(ContainerBuilder $container, $filename)
    {
        $loader = new IniFileLoader($container, new FileLocator());
        $loader->load($filename);

        return $container;
    }
}