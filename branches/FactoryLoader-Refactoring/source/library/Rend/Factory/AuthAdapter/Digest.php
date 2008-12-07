<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Zend_Auth_Adapter_Digest */
require_once "Zend/Auth/Adapter/Digest.php";

/**
 *
 */
class Rend_Factory_AuthAdapter_Digest extends Rend_FactoryLoader_Factory_Abstract
{

    /**
     * Filename
     * @var string
     */
    protected $_filename;

    /**
     * Realm
     * @var string
     */
    protected $_realm;

    /**
     * Username
     * @var string
     */
    protected $_username;

    /**
     * Password
     * @var string
     */
    protected $_password;

    /**
     * Create a digest auth adapter
     *
     * @return Zend_Auth_Adapter_Digest
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
     * Set the filename
     *
     * @param string $filename
     * @return Rend_Factory_AuthAdapter_Digest
     */
    public function setFilename($filename)
    {
        $this->_filename = $filename;
        return $this;
    }

    /**
     * Set the password
     *
     * @param string $password
     * @return Rend_Factory_AuthAdapter_Digest
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * Set the realm
     *
     * @param string $realm
     * @return Rend_Factory_AuthAdapter_Digest
     */
    public function setRealm($realm)
    {
        $this->_realm = $realm;
        return $this;
    }

    /**
     * Set the username
     *
     * @param string $username
     * @return Rend_Factory_AuthAdapter_Digest
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }

}
