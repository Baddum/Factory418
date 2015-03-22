<?php

namespace Baddum\Factory418\Test;

use Baddum\Factory418\Test\Resource\SimpleFactory;
use Baddum\Factory418\Test\Resource\SmartException;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    protected static $simpleFactory;
    protected static $smartException;

    public static function setUpBeforeClass()
    {
        (new SimpleFactory)->registerClass('stdClass', 'std');
        (new SmartException)
            ->registerClass('Exception', 'std')
            ->registerClass(new \PDOException, ['PDO', 'SQL'])
            ->registerInstance(new \RuntimeException('Something bad happened!'), '500');
    }

    public function testGetInstance()
    {
        $instance = (new SimpleFactory)->getInstance('std');
        $this->assertInstanceOf('stdClass', $instance);
    }

    public function testGetInstanceMultiple()
    {
        $smartException = new SmartException;
        $instance = $smartException->getInstance('std');
        $this->assertInstanceOf('Exception', $instance);
        $instance = $smartException->getInstance('PDO');
        $this->assertInstanceOf('PDOException', $instance);
        $instance = $smartException->getInstance('SQL');
        $this->assertInstanceOf('PDOException', $instance);
        $instance = $smartException->getInstance('sql');
        $this->assertInstanceOf('PDOException', $instance);
        $instance = $smartException->getInstance('500');
        $this->assertInstanceOf('RuntimeException', $instance);
        $this->assertEquals('Something bad happened!', $instance->getMessage());
    }

    public function testIndexNotFound()
    {
        $this->setExpectedException('RuntimeException');
        (new SimpleFactory)->getInstance('coco');
    }

    public function testIndexNotFoundCustom()
    {
        $factory = new SmartException;
        $instance = $factory->getInstance('coco');
        $this->assertEquals($factory, $instance);
    }

    public function testIndexOverride()
    {
        $this->setExpectedException('RuntimeException');
        (new SimpleFactory)->registerClass('Exception', 'std');
    }

    public function testIndexOverrideAllowed()
    {
        (new SimpleFactory)->registerClass('Exception', 'std', true);
        $instance = (new SimpleFactory)->getInstance('std');
        $this->assertInstanceOf('Exception', $instance);
    }

    public function testIndexOverrideCustom()
    {
        (new SmartException)->registerClass('RuntimeException', 'sql');
        $instance = (new SmartException)->getInstance('sql');
        $this->assertInstanceOf('RuntimeException', $instance);
    }
}