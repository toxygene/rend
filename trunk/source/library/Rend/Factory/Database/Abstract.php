<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Rend_Factory_Database_Interface */
require_once "Rend/Factory/Database/Interface.php";

/**
 *
 */
abstract class Rend_Factory_Database_Abstract extends Rend_FactoryLoader_Factory_Abstract implements Rend_Factory_Database_Interface
{

    /**#@+
     * Case folding constant
     * @var string
     */
    const CASE_FOLDING_NATURAL = "natural";
    const CASE_FOLDING_LOWER   = "lower";
    const CASE_FOLDING_UPPER   = "upper";
    /**#@-*/

    /**#@+
     * Fetch mode constant
     * @var string
     */
    const FETCH_MODE_LAZY  = "lazy";
    const FETCH_MODE_ASSOC = "assoc";
    const FETCH_MODE_NUM   = "num";
    const FETCH_MODE_BOTH  = "both";
    const FETCH_MODE_NAMED = "named";
    const FETCH_MODE_OBJ   = "obj";
    /**#@-*/

    /**
     * Database options
     * @var array
     */
    protected $_options = array(
        "driverOptions" => array()
    );

    /**
     * Statement class
     * @var string
     */
    protected $_statementClass;

    /**
     * Set the auto quote identifiers flag
     *
     * @param boolean $autoQuoteIdentifiers
     * @return Rend_Factory_Database_Abstract
     */
    public function setAutoQuoteIdentifiers($autoQuoteIdentifiers)
    {
        $this->_options["autoQuoteIdentifiers"] = (boolean) $autoQuoteIdentifiers;
        return $this;
    }

    /**
     * Set the case folding value
     *
     * @param integer $caseFolding
     * @return Rend_Factory_Database_Abstract
     */
    public function setCaseFolding($caseFolding)
    {
        switch ($caseFolding) {
            case self::CASE_FOLDING_NATURAL:
                $this->_options["caseFolding"] = Zend_Db::CASE_NATURAL;
            break;

            case self::CASE_FOLDING_LOWER:
                $this->_options["caseFolding"] = Zend_Db::CASE_LOWER;
            break;

            case self::CASE_FOLDING_UPPER:
                $this->_options["caseFolding"] = Zend_Db::CASE_UPPER;
            break;

            default:
                /** Rend_Factory_Database_Exception */
                require_once "Rend/Factory/Database/Exception.php";

                throw new Rend_Factory_Database_Exception("Case folding '{$caseFolding}' is unsupported or unknown");
            break;
        }
        return $this;
    }

    /**
     * Set the fetch mode
     *
     * @param string $fetchMode
     * @return Rend_Factory_Database_Abstract_Pdo
     */
    public function setFetchMode($fetchMode)
    {
        switch ($fetchMode) {
            case self::FETCH_MODE_LAZY:
                $this->_options["fetchMode"] = Zend_Db::FETCH_LAZY;
            break;

            case self::FETCH_MODE_ASSOC:
                $this->_options["fetchMode"] = Zend_Db::FETCH_ASSOC;
            break;

            case self::FETCH_MODE_NUM:
                $this->_options["fetchMode"] = Zend_Db::FETCH_NUM;
            break;

            case self::FETCH_MODE_BOTH:
                $this->_options["fetchMode"] = Zend_Db::FETCH_BOTH;
            break;

            case self::FETCH_MODE_NAMED:
                $this->_options["fetchMode"] = Zend_Db::FETCH_NAMED;
            break;

            case self::FETCH_MODE_OBJ:
                $this->_options["fetchMode"] = Zend_Db::FETCH_OBJ;
            break;

            default:
                /** Rend_Factory_Database_Exception */
                require_once "Rend/Factory/Database/Exception.php";

                throw new Rend_Factory_Database_Exception("Fetch mode '{$fetchMode}' is unsupported or unknown");
            break;
        }
        return $this;
    }

    /**
     * Set the host
     *
     * @param string $host
     * @return Rend_Factory_Database_Abstract
     */
    public function setHost($host)
    {
        $this->_options["host"] = $host;
        return $this;
    }

    /**
     * Set the password
     *
     * @param string $password
     * @return Rend_Factory_Database_Abstract
     */
    public function setPassword($password)
    {
        $this->_options["password"] = $password;
        return $this;
    }

    /**
     * Set the persistent flag
     *
     * @param boolean $persistent
     * @return Rend_Factory_Database_Abstract
     */
    public function setPersistent($persistent)
    {
        $this->_options["persistent"] = $persistent;
        return $this;
    }

    /**
     * Set the port
     *
     * @param integer $port
     * @return Rend_Factory_Database_Abstract
     */
    public function setPort($port)
    {
        $this->_options["port"] = $port;
        return $this;
    }

    /**
     * Set the profiler
     *
     * @param mixed $profiler
     * @return Rend_Factory_Database_Abstract
     */
    public function setProfiler($profiler)
    {
        $this->_options["profiler"] = $profiler;
        return $this;
    }

    /**
     * Set the protocol
     *
     * @param string $protocol
     * @return Rend_Factory_Database_Abstract
     */
    public function setProtocol($protocol)
    {
        $this->_options["protocol"] = $protocol;
        return $this;
    }

    /**
     * Set the schema (aka database name)
     *
     * @param string $schema
     * @return Rend_Factory_Database_Abstract
     */
    public function setSchema($schema)
    {
        $this->_options["dbname"] = $schema;
        return $this;
    }

    /**
     * Set the statement class
     *
     * @param string $statementClass
     * @return Rend_Factory_Database_Abstract
     */
    public function setStatementClass($statementClass)
    {
        $this->_statementClass = $statementClass;
        return $this;
    }

    /**
     * Set the username
     *
     * @param string $username
     * @return Rend_Factory_Database_Abstract
     */
    public function setUsername($username)
    {
        $this->_options["username"] = $username;
        return $this;
    }

}
