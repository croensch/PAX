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
     * @param \Hgs_Dom_Schema $schema
     */
    protected function setSchema(\Hgs_Dom_Schema $schema)
    {
        $this->_schema = $schema;
    }

    /**
     * @return \Hgs_Dom_Schema
     */
    protected function getSchema()
    {
        return $this->_schema;
    }
}
