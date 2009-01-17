<?php
/**
 *
 */

/** Rend_Base_Abstract */
require_once "Rend/Base/Abstract.php";

/** Rend_Factory_AuthStorage_Interface */
require_once "Rend/Factory/AuthStorage/Interface.php";

/**
 *
 */
class Rend_Factory_AuthStorage_NonPersistent extends Rend_Base_Abstract implements Rend_Factory_AuthStorage_Interface
{

    /**
     * Create a non-persistent storage
     *
     * @return Zend_Auth_Storage_NonPersistent
     */
    public function create()
    {
        /** Zend_Auth_Storage_NonPersistent */
        require_once "Zend/Auth/Storage/NonPersistent.php";

        return new Zend_Auth_Storage_NonPersistent();
    }

}
