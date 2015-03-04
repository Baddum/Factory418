<?php

namespace Baddum\Factory418\Test\Resource;

use Baddum\Factory418\FactoryTrait;

class SmartException extends \Exception
{
    use FactoryTrait;

    protected function onClassIndexOverride($index)
    {
        
    }

    protected function onNoClassIndexFound($index)
    {
        return get_class($this);
    }
}