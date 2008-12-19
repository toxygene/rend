<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Zend_Auth_Storage_NonPersistent */
require_once "Zend/Auth/Storage/NonPersistent.php";

/**
 *
 */
class Rend_Factory_AuthStorage_NonPersistent extends Rend_FactoryLoader_Factory_Abstract
{

    /**
     * Create a non-persistent storage
     *
     * @return Zend_Auth_Storage_NonPersistent
     */
    public function create()
    {
        return new Zend_Auth_Storage_NonPersistent();
    }

}
