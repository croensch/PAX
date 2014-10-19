<?php
namespace PAX\Dom\Codec\Schema;

/**
 * TEMPORARY
 */
trait SchemaTrait
{
    /**
     * @var \Hgs_Dom_Schema $schema
     */
    protected $_schema;

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        if (isset($options['schema'])) {
            $this->_setSchema($options['schema']);
        }

        parent::__construct($options);
    }

    /**
     * @param \Hgs_Dom_Schema $schema
     */
    protected function _setSchema(\Hgs_Dom_Schema $schema)
    {
        $this->_schema = $schema;
    }

    /**
     * @return \Hgs_Dom_Schema
     */
    protected function _getSchema()
    {
        return $this->_schema;
    }
}