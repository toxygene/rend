<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Rend_Factory_MailTransport_Interface */
require_once "Rend/Factory/MailTransport/Interface.php";

/**
 *
 */
class Rend_Factory_MailTransport_Smtp extends Rend_FactoryLoader_Factory_Abstract implements Rend_Factory_MailTransport_Interface
{

    /**
     * Connection
     * @var Zend_Mail_Protocol_Abstract
     */
    protected $_connection;

    /**
     * Hostname
     * @var string
     */
    protected $_host;

    /**
     * SMTP options
     * @var array
     */
    protected $_options;

    /**
     * Get a SMTP transport object
     *
     * @return Zend_Mail_Transport_Smtp
     */
    public function create()
    {
        /** Zend_Mail_Transport_Smtp */
        require_once "Zend/Mail/Transport/Smtp.php";

        $smtp = new Zend_Mail_Transport_Smtp(
            $this->_host,
            $this->_options
        );

        if ($this->_connection) {
            $smtp->setConnection($this->_connection);
        }

        return $this;
    }

    /**
     * Set the auth type
     *
     * @param string $auth
     */
    public function setAuth($auth)
    {
        $this->_options["auth"] = $auth;
        return $this;
    }

    /**
     * Set the connection
     *
     * @param Zend_Mail_Protocol_Abstract $connection
     * @return Rend_Factory_MailTransport_Smtp
     */
    public function setConnection(Zend_Mail_Protocol_Abstract $connection)
    {
        $this->_connection = $connection;
        return $this;
    }

    /**
     * Set the host name
     *
     * @param string $host
     * @return Rend_Factory_MailTransport_Smtp
     */
    public function setHost($host)
    {
        $this->_host = $host;
        return $this;
    }

    /**
     * Set the name
     *
     * @param string $name
     * @return Rend_Factory_MailTransport_Smtp
     */
    public function setName($name)
    {
        $this->_options["name"] = $name;
        return $this;
    }

    /**
     * Set the password
     *
     * @param string $password
     * @return Rend_Factory_MailTransport_Smtp
     */
    public function setPassword($password)
    {
        $this->_options["password"] = $password;
        return $this;
    }

    /**
     * Set the port
     *
     * @param integer $port
     * @return Rend_Factory_MailTransport_Smtp
     */
    public function setPort($port)
    {
        $this->_options["port"] = $port;
        return $this;
    }

    /**
     * Set the username
     *
     *  @param string $username
     *  @return Rend_Factory_MailTransport_Smtp
     */
    public function setUsername($username)
    {
        $this->_options["username"] = $username;
        return $this;
    }

}
