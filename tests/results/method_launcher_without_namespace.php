<?php
use Kumatch\MethodLauncher as MethodLauncher0393702551625b9a73f84b6e3eb1afc0b1aca5bd;

/**
 * @method \DateTime launchTestDate
 * @method \Path\To\Test\FooBar launchFoobar
 */
class BarLauncher extends MethodLauncher0393702551625b9a73f84b6e3eb1afc0b1aca5bd
{
    public function __construct()
    {
        $this->container = unserialize(<<<CONTAINER_0393702551625b9a73f84b6e3eb1afc0b1aca5bd
__SERIALIZED_CONTAINER__
CONTAINER_0393702551625b9a73f84b6e3eb1afc0b1aca5bd
        );
    }
}