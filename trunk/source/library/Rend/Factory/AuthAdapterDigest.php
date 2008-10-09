<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_AuthAdapter_Interface */
require_once 'Rend/Factory/AuthAdapter/Interface.php';

/** Zend_Auth_Adapter_Digest */
require_once 'Zend/Auth/Adapter/Digest.php';

/**
 *
 */
class Rend_Factory_AuthAdapterDigest extends Rend_Factory_Abstract implements Rend_Factory_AuthAdapter_Interface
{

    /**
     * @var     string
     */
    protected $_filename;

    /**
     * @var     string
     */
    protected $_realm;

    /**
     * @var     string
     */
    protected $_username;

    /**
     * @var     string
     */
    protected $_password;

    /**
     * @return  Zend_Auth_Adapter_Digest
     */
    public function create()
    {
        return new Zend_Auth_Adapter_Digest(
            $this->_filename,
            $this->_realm,
            $this->_username,
            $this->_password
        );
    }

    /**
     *
     */
    public function setFilename($filename)
    {
        $this->_filename = $filename;
        return $this;
    }

    /**
     *
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     *
     */
    public function setRealm($realm)
    {
        $this->_realm = $realm;
        return $this;
    }

    /**
     *
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }

}
