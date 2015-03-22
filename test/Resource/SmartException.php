<?php

namespace Baddum\Factory418\Test\Resource;

use Baddum\Factory418\FactoryTrait;

class SmartException extends \Exception
{
    use FactoryTrait;

    protected function _onFactoryIndexOverride($index)
    {
        
    }

    protected function _onFactoryIndexNotFound($index)
    {
        return $this;
    }
}