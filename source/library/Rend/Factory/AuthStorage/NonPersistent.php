<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Loader_Abstract */
require_once 'Rend/FactoryLoader/Factory/Loader/Abstract.php';

/** Zend_Auth_Storage_NonPersistent */
require_once 'Zend/Auth/Storage/NonPersistent.php';

/**
 *
 */
class Rend_Factory_AuthStorage_NonPersistent extends Rend_FactoryLoader_Factory_Loader_Abstract
{

    /**
     * Create method for factory
     *
     * @return  Zend_Auth_Storage_NonPersistent
     */
    public function create()
    {
        return new Zend_Auth_Storage_NonPersistent();
    }

}
