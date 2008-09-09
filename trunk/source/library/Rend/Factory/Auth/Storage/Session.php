<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_Auth_Storage_Interface */
require_once 'Rend/Factory/Auth/Storage/Interface.php';

/** Zend_Auth_Storage_Session */
require_once 'Zend/Auth/Storage/Session.php';

/**
 *
 */
class Rend_Factory_Auth_Storage_Session extends Rend_Factory_Abstract implements Rend_Factory_Auth_Storage_Interface
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
     * Create method for factory
     *
     * @return  Zend_Auth_Storage_Interface
     */
    public function create()
    {
        return new Zend_Auth_Storage_Session(
            $this->getNamespace(),
            $this->getMember()
        );
    }

    /**
     * Get the member name
     *
     * @return  string
     */
    public function getMember()
    {
        return $this->_member;
    }

    /**
     * Get the namespace name
     *
     * @return  string
     */
    public function getNamespace()
    {
        return $this->_namespace;
    }

    /**
     * Set the member name
     *
     * @param   string  $member
     * @return  Rend_Factory_Auth_Storage_Session
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
     * @return  Rend_Factory_Auth_Storage_Session
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = $namespace;
        return $this;
    }

}
