<?php
namespace Path\To;
use Kumatch\PropertyLauncher as PropertyLauncher4514fa1bc1752a995a2571dc9bfb1a01bb773b4a;

/**
 * @property \DateTime TestDate
 * @property \Path\To\Test\FooBar Foobar
 */
class FooLauncher extends PropertyLauncher4514fa1bc1752a995a2571dc9bfb1a01bb773b4a
{
    public function __construct()
    {
        $this->container = unserialize(<<<CONTAINER_4514fa1bc1752a995a2571dc9bfb1a01bb773b4a
__SERIALIZED_CONTAINER__
CONTAINER_4514fa1bc1752a995a2571dc9bfb1a01bb773b4a
        );
    }
}