<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Loader_Abstract */
require_once "Rend/FactoryLoader/Factory/Loader/Abstract.php";

/** Zend_Auth_Storage_Session */
require_once "Zend/Auth/Storage/Session.php";

/**
 *
 */
class Rend_Factory_AuthStorage_Session extends Rend_FactoryLoader_Factory_Loader_Abstract
{

    /**
     * Member name
     * @var     string
     */
    protected $_member;

    /**
     * Namespace name
     * @var     string
     */
    protected $_namespace;

    /**
     * Create a session storage
     *
     * @return  Zend_Auth_Storage_Session
     */
    public function create()
    {
        return new Zend_Auth_Storage_Session(
            $this->_namespace,
            $this->_member
        );
    }

    /**
     * Set the member name
     *
     * @param   string  $member
     * @return  Rend_Factory_AuthStorage_Session
     */
    public function setMember($member)
    {
        $this->_member = $member;
        return $this;
    }

    /**
     * Set the namespace name
     *
     * @param   string  $namespace
     * @return  Rend_Factory_AuthStorage_Session
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = $namespace;
        return $this;
    }

}
