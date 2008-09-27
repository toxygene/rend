<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_AuthStorage_Interface */
require_once 'Rend/Factory/AuthStorage/Interface.php';

/** Zend_Auth_Storage_NonPersistent */
require_once 'Zend/Auth/Storage/NonPersistent.php';

/**
 *
 */
class Rend_Factory_AuthStorage_NonPersistent extends Rend_Factory_Abstract implements Rend_Factory_AuthStorage_Interface
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
