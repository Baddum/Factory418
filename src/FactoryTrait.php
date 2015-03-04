<?php

namespace Baddum\Factory418;

trait FactoryTrait
{

    /* ATTRIBUTES
     *************************************************************************/
    private static $indexList = [];


    /* PUBLIC METHODS
     *************************************************************************/

    /**
     * @param string|object $className
     * @param array|string $indexList
     * 
     * @return self
     */
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

    /**
     * @param string $index
     *
     * @return string
     */
    public function retrieveClass($index)
    {
        $index = strtolower($index);
        if (!$this->hasIndex($index)) {
            return $this->onNoClassIndexFound($index);
        }
        return $this->getIndex($index);
    }

    /**
     * @param string $index
     * @param array|string $arguments (optional)
     *
     * @return string
     */
    public function newInstance($index, $arguments = [])
    {
        $className = $this->retrieveClass($index);
        $reflect  = new \ReflectionClass($className);
        if (!is_array($arguments)) {
            $arguments = [$arguments];
        }
        return $reflect->newInstanceArgs($arguments);
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

    /**
     * @param string $index
     * @param string $className
     *
     * @throw RuntimeException
     * @return void
     */
    protected function onClassIndexOverride($index, $className)
    {
        throw new \RuntimeException('Class already registered for the index: ' . $index);
    }

    /**
     * @param string $index
     *
     * @throw RuntimeException
     * @return string
     */
    protected function onNoClassIndexFound($index)
    {
        throw new \RuntimeException('No class registered for the index: ' . $index);
    }
}