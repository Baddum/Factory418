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
            ->registerClass('PDOException', ['PDO', 'SQL']);
    }

    public function testSimpleNewInstance()
    {
        $instance = (new SimpleFactory)->newInstance('std');
        $this->assertInstanceOf('stdClass', $instance);
    }

    public function testSimpleClassNotFound()
    {
        $this->setExpectedException('RuntimeException');
        (new SimpleFactory)->newInstance('coco');
    }

    public function testSmartNewInstance()
    {
        $smartException = new SmartException;
        $instance = $smartException->newInstance('std');
        $this->assertInstanceOf('Exception', $instance);
        $instance = $smartException->newInstance('PDO');
        $this->assertInstanceOf('PDOException', $instance);
        $instance = $smartException->newInstance('SQL');
        $this->assertInstanceOf('PDOException', $instance);
        $instance = $smartException->newInstance('sql');
        $this->assertInstanceOf('PDOException', $instance);
    }

    public function testSmartClassNotFound()
    {
        $instance = (new SmartException)->newInstance('coco');
        $this->assertInstanceOf(get_class(new SmartException), $instance);
    }
}