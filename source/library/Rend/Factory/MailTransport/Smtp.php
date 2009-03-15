<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category Rend
 * @package Factory
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Base_Abstract */
require_once "Rend/Base/Abstract.php";

/** Rend_Factory_MailTransport_Interface */
require_once "Rend/Factory/MailTransport/Interface.php";

/**
 * @category Rend
 * @package Factory
 */
class Rend_Factory_MailTransport_Smtp extends Rend_Base_Abstract implements Rend_Factory_MailTransport_Interface
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
    protected $_options = array();

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

        return $smtp;
    }

    /**
     * Set the auth type
     *
     * @param string $auth
     * @return Rend_Factory_MailTransport_Smtp
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
