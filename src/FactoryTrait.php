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
        if (!is_array($indexList)) {
            $indexList = [$indexList];
        }
        foreach ($indexList as $index) {
            $index = strtolower($index);
            if ($this->hasIndex($index)) {
                $this->onClassIndexOverride($index, $className);
            }
            $this->setIndex($index, $className);
        }
        return $this;
    }

    public function retrieveClass($index)
    {
        $index = strtolower($index);
        if (!$this->hasIndex($index)) {
            return $this->onNoClassIndexFound($index);
        }
        return $this->getIndex($index);
    }

    public function newInstance($index)
    {
        $className = $this->retrieveClass($index);
        return new $className;
    }


    /* PRIVATE INDEX METHODS
     *************************************************************************/
    private function setIndex($index, $className)
    {
        $factoryName = get_called_class();
        if (!isset(self::$indexList[$factoryName])) {
            self::$indexList[$factoryName] = [];
        }
        self::$indexList[$factoryName][$index] = $className;
    }

    private function hasIndex($index)
    {
        $factoryName = get_called_class();
        if (!isset(self::$indexList[$factoryName])) {
            return false;
        }
        return isset(self::$indexList[$factoryName][$index]);
    }

    private function getIndex($index)
    {
        $factoryName = get_called_class();
        return self::$indexList[$factoryName][$index];
    }


    /* PROTECTED ERROR METHODS
     *************************************************************************/
    protected function onClassIndexOverride($index, $className)
    {
        throw new \RuntimeException('Class already registered for the index: ' . $index);
    }
    
    protected function onNoClassIndexFound($index)
    {
        throw new \RuntimeException('No class registered for the index: ' . $index);
    }
}