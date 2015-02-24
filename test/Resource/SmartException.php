<?php

namespace Baddum\Factory418\Test\Resource;

use Baddum\Factory418\FactoryTrait;

class SmartException extends \Exception
{
    use FactoryTrait;

    protected function onNoClassRegistered($index)
    {
        return $this;
    }
}