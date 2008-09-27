<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_Configurable_Abstract */
require_once 'Rend/Factory/Configurable/Abstract.php';

/**
 *
 */
class Rend_Factory_Database extends Rend_Factory_Configurable_Abstract
{

    /**
     * Adapter name
     * @var     string
     */
    private $_adapter;

    /**
     * Adapter parameters
     * @var     array
     */
    private $_params;

    /**
     * Get a database object
     *
     * @return  Zend_Db_Adapter_Abstract
     */
    public function create()
    {
        return Zend_Db::factory(
            $this->adapter,
            $this->params
        );
    }

    /**
     * Set the database adapter type
     *
     * @param   string  $adapter
     * @return  Rend_Factory_Database
     */
    public function setAdapter($adapter)
    {
        $this->_adapter = $adapter;
        return $this;
    }

    /**
     * Set the database parameters
     *
     * @param   array   $params
     * @return  Rend_Factory_Database
     */
    public function setParams(array $params)
    {
        $this->_params = $params;
        return $this;
    }

}
