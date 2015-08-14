<?php
namespace PAX\Soap\Util;

class ArrayOfTypeSequence implements \IteratorAggregate, \Countable
{
    /**
     * @var string
     */
    protected $_name;

    /**
     * @var \ArrayIterator
     */
    protected $_iterator;

    /**
     * @internal
     * @var string $name
     * @var mixed $item
     */
    public function __set($name, $item)
    {
        $this->_iterator = null;

        $this->_name = $name;
        $this->$name = is_array($item) ? $item : array($item);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        if ($this->_iterator === null) {
            if (($name = $this->_name) && isset($this->$name)) {
                $this->_iterator = new \ArrayIterator($this->$name);
            } else {
                $this->_iterator = new \ArrayIterator();
            }
            $this->_name = null;
        }
        return $this->_iterator;
    }

    /**
     * @return integer
     */
    public function count()
    {
        return $this->getIterator()->count();
    }
}
