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
     * @param boolean $override
     *
     * @return self
     */
    public function registerClass($className, $indexList, $override = false)
    {
        if (is_object($className)) {
            $className = get_class($className);
        }
        if (!is_array($indexList)) {
            $indexList = [$indexList];
        }
        foreach ($indexList as $index) {
            $this->_setFactoryIndex($index, $className, $override);
        }
        return $this;
    }

    /**
     * @param object $instance
     * @param array|string $indexList
     * @param boolean $override
     *
     * @return self
     */
    public function registerInstance($instance, $indexList, $override = false)
    {
        if (!is_array($indexList)) {
            $indexList = [$indexList];
        }
        foreach ($indexList as $index) {
            $this->_setFactoryIndex($index, $instance, $override);
        }
        return $this;
    }

    /**
     * @param string $index
     *
     * @return string
     */
    public function getInstance($index)
    {
        $index = strtolower($index);
        if (!$this->_hasFactoryIndex($index)) {
            return $this->_onFactoryIndexNotFound($index);
        }
        $instance = $this->_getFactoryIndex($index);
        if (is_string($instance)) {
            return new $instance;
        }
        return $instance;
    }


    /* PRIVATE INDEX METHODS
     *************************************************************************/
    private function _setFactoryIndex($index, $className, $override)
    {
        $index = strtolower($index);
        if ($this->_hasFactoryIndex($index)) {
            $this->_onFactoryIndexOverride($index, $className, $override);
        }
        $factoryName = get_called_class();
        if (!isset(self::$indexList[$factoryName])) {
            self::$indexList[$factoryName] = [];
        }
        self::$indexList[$factoryName][$index] = $className;
    }

    private function _hasFactoryIndex($index)
    {
        $factoryName = get_called_class();
        if (!isset(self::$indexList[$factoryName])) {
            return false;
        }
        return isset(self::$indexList[$factoryName][$index]);
    }

    private function _getFactoryIndex($index)
    {
        $factoryName = get_called_class();
        return self::$indexList[$factoryName][$index];
    }


    /* PROTECTED ERROR METHODS
     *************************************************************************/

    /**
     * @param string $index
     * @param mixed $value
     * @param boolean $override
     *
     * @throw RuntimeException
     * @return void
     */
    protected function _onFactoryIndexOverride($index, $value, $override)
    {
        if (!$override) {
            throw new \RuntimeException('Try to register "' . $value . '", but index already in use: ' . $index);
        }
    }

    /**
     * @param string $index
     *
     * @throw RuntimeException
     * @return string
     */
    protected function _onFactoryIndexNotFound($index)
    {
        throw new \RuntimeException('Try to retrieve "' . $index . '", but nothing found');
    }
}