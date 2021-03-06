Launcher generator
===========

A generator for [kumatch/launcher](https://github.com/kumatch/php-launcher).

[![Build Status](https://travis-ci.org/kumatch/php-launcher-generator.png?branch=master)](https://travis-ci.org/kumatch/php-launcher-generator)

Install
-----

    $ composer require kumatch/launcher-generator


Usage
------

Generates launcher class by specific service file,

    $ ./vendor/bin/launcher-generator -t method -c MyLauncher -n Path\\To\\MyApp /path/to/services.yml > /path/to/src/MyLauncher.php

and here is output code, with annotation docblock (@property or @method) for getting service. So if you use this launcher class your application, will get hints (auto-completion) for each services, not Symfony platform, not written @var/@type hints in IDE (ex. PHPStorm).

```php
<?php
namespace Path\To\MyApp;
use Kumatch\MethodLauncher as MethodLauncher0502cc4bdf3469404dfad1fefb26dd2bf1a2c37d;

/**
 * @method \Path\To\Test\FooBar launchFoobar
 * @method \DateTime launchTestDate
 */
class MyLauncher extends MethodLauncher0502cc4bdf3469404dfad1fefb26dd2bf1a2c37d
{
    public function __construct()
    {
        $this->container = unserialize(<<<CONTAINER_0502cc4bdf3469404dfad1fefb26dd2bf1a2c37d
O:54:"Symfony\Component\DependencyInjection\ContainerBuilder":21:{s:66:"...
CONTAINER_0502cc4bdf3469404dfad1fefb26dd2bf1a2c37d
        );
    }
}
```


License
--------

Licensed under the MIT License.

Copyright (c) 2014 Yosuke Kumakura

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
