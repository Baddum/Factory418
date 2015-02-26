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
        if (!isset(self::$indexList[$factoryName])) {
            self::$indexList[$factoryName] = [];
        }
        if (!is_array($indexList)) {
            $indexList = [$indexList];
        }
        foreach ($indexList as $index) {
            $id = strtolower($index);
            self::$indexList[$factoryName][$id] = $className;
        }
        return $this;
    }

    public function newInstance($index)
    {
        $factoryName = get_called_class();
        if (!isset(self::$indexList[$factoryName])) {
            return $this->onNoClassIndexFound($index);
        }
        $id = strtolower($index);
        if (!isset(self::$indexList[$factoryName][$id])) {
            return $this->onNoClassIndexFound($index);
        }
        $className = self::$indexList[$factoryName][$id];
        return new $className;
    }


    /* PROTECTED METHODS
     *************************************************************************/
    protected function onNoClassIndexFound($index)
    {
        throw new \RuntimeException('No class registered for the index: ' . $index);
    }
}