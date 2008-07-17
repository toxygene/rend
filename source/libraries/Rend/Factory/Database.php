<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Zend/Factory/Abstract.php';

/**
 *
 */
class Rend_Factory_Database extends Rend_Factory_Abstract
{

    /**
     * Get a database object
     *
     * @return  Zend_Db_Adapter_Abstract
     */
    public function create()
    {
        return Zend_Db::factory($this->_config->rend->factory->database);
    }

}
