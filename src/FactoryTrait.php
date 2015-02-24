<?php

namespace Baddum\Factory418;

trait FactoryTrait
{

    /* ATTRIBUTES
     *************************************************************************/
    private static $indexList = [];


    /* PUBLIC METHODS
     *************************************************************************/
    public function registerClass($className, $indexList)
    {
        if (is_object($className)) {
            $className = get_class($className);
        }
        $factoryName = get_called_class();
        if (!isset(static::$indexList[$factoryName])) {
            static::$indexList[$factoryName] = [];
        }
        if (!is_array($indexList)) {
            $indexList = [$indexList];
        }
        foreach ($indexList as $index) {
            $id = strtolower($index);
            static::$indexList[$factoryName][$id] = $className;
        }
        return $this;
    }

    public function newInstance($index)
    {
        $factoryName = get_called_class();
        if (!isset(static::$indexList[$factoryName])) {
            return $this->onNoClassRegistered($index);
        }
        $id = strtolower($index);
        if (!isset(static::$indexList[$factoryName][$id])) {
            return $this->onNoClassRegistered($index);
        }
        $className = static::$indexList[$factoryName][$id];
        return new $className;
    }


    /* PROTECTED METHODS
     *************************************************************************/
    protected function onNoClassRegistered($index)
    {
        throw new \RuntimeException('No class registered for the index: ' . $index);
        return false;
    }


}