<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_Auth_Storage_Interface */
require_once 'Rend/Factory/Auth/Storage/Interface.php';

/** Zend_Auth_Storage_NonPersistent */
require_once 'Zend/Auth/Storage/NonPersistent.php';

/**
 *
 */
class Rend_Factory_Auth_Storage_NonPersistent extends Rend_Factory_Abstract implements Rend_Factory_Auth_Storage_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Auth_Storage_Interface
     */
    public function create()
    {
        return new Zend_Auth_Storage_NonPersistent();
    }

}
