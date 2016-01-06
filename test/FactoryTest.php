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
        (new SimpleFactory())->registerClass('stdClass', 'std');
        (new SmartException())
            ->registerClass('Exception', 'std')
            ->registerClass(new \PDOException(), ['PDO', 'SQL']);
    }

    public function testRetrieveClass()
    {
        $className = (new SimpleFactory())->retrieveClass('std');
        $this->assertEquals('stdClass', $className);
    }

    public function testNewInstance()
    {
        $instance = (new SimpleFactory())->newInstance('std');
        $this->assertInstanceOf('stdClass', $instance);
    }

    public function testNewInstanceWithOneArgument()
    {
        $instance = (new SmartException())->newInstance('sql', 'test');
        $this->assertInstanceOf('PDOException', $instance);
        $this->assertEquals('test', $instance->getMessage());
    }

    public function testNewInstanceWithArguments()
    {
        $instance = (new SmartException())->newInstance('sql', ['test', 418]);
        $this->assertInstanceOf('PDOException', $instance);
        $this->assertEquals('test', $instance->getMessage());
        $this->assertEquals(418, $instance->getCode());
    }

    public function testNewInstanceMultiple()
    {
        $smartException = new SmartException();
        $instance = $smartException->newInstance('std');
        $this->assertInstanceOf('Exception', $instance);
        $instance = $smartException->newInstance('PDO');
        $this->assertInstanceOf('PDOException', $instance);
        $instance = $smartException->newInstance('SQL');
        $this->assertInstanceOf('PDOException', $instance);
        $instance = $smartException->newInstance('sql');
        $this->assertInstanceOf('PDOException', $instance);
    }

    public function testClassNotFound()
    {
        $this->setExpectedException('RuntimeException');
        (new SimpleFactory())->newInstance('coco');
    }

    public function testClassNotFoundCustom()
    {
        $instance = (new SmartException())->newInstance('coco');
        $this->assertInstanceOf(get_class(new SmartException()), $instance);
    }

    public function testClassIndexOverride()
    {
        $this->setExpectedException('RuntimeException');
        (new SimpleFactory())->registerClass('Exception', 'std');
    }

    public function testClassIndexOverrideCustom()
    {
        (new SmartException())->registerClass('RuntimeException', 'sql');
        $instance = (new SmartException())->newInstance('sql');
        $this->assertInstanceOf('RuntimeException', $instance);
    }
}
