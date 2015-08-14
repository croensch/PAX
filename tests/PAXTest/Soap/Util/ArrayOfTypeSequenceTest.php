<?php
namespace PAXTest\Soap\Util;

use PAX\Soap\Util\ArrayOfTypeSequence;

class ArrayOfTypeSequenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArrayOfTypeSequence
     */
    private $sequence;

    /**
     * @var array
     */
    protected $_cats = array('cat_one', 'cat_two');

    /**
     * @var array
     */
    protected $_dogs = array('dog_one', 'dog_two');

    public function setUp()
    {
        parent::setUp();
        $this->sequence = new ArrayOfTypeSequence();
    }

    public function tearDown()
    {
        $this->sequence = null;
        parent::tearDown();
    }

    public function testSet()
    {
        $this->sequence->cats = $this->_cats;
        $this->assertSame($this->_cats, $this->sequence->cats, "Array cats");

        $this->sequence->dogs = $this->_dogs;
        $this->assertSame($this->_dogs, $this->sequence->dogs, "Array dogs");

        $item = new \stdClass;
        $this->sequence->item = $item;
        $this->assertEquals(
            array($item),
            $this->sequence->item,
            "stdClass item"
        );
    }

    public function testGetIterator()
    {
        $this->assertEquals(
            new \ArrayIterator(),
            $this->sequence->getIterator(),
            "by default"
        );

        $this->sequence->temp = array();
        unset($this->sequence->temp);
        $this->assertEquals(
            new \ArrayIterator(),
            $this->sequence->getIterator(),
            "on unset"
        );

        $this->sequence->cats = $this->_cats;
        $this->assertSame(
            $this->_cats,
            $this->sequence->getIterator()->getArrayCopy(),
            "for 'cats'"
        );

        $this->sequence->dogs = $this->_dogs;
        $this->assertSame(
            $this->_dogs,
            $this->sequence->getIterator()->getArrayCopy(),
            "for 'dogs'"
        );
    }

    /**
     * Counting
     */
    public function testCount()
    {
        $this->sequence->test = array(1, 2, 3);
        $this->assertCount(3, $this->sequence);
    }

    /**
     * Iterating
     */
    public function testIterate()
    {
        $this->sequence->cats = $this->_cats;
        foreach ($this->sequence as $cat) {
            $this->assertStringStartsWith('cat_', $cat, 'iterate $sequence');
        }

        $this->sequence->dogs = $this->_dogs;
        foreach ($this->sequence->dogs as $dog) {
            $this->assertStringStartsWith('dog_', $dog, 'iterate $sequence->$name');
        }
    }
}
