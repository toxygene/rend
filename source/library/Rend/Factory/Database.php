<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/**
 *
 */
abstract class Rend_Factory_Database extends Rend_FactoryLoader_Factory_Abstract
{

    /**#@+
     * Case folding constant
     * @var     string
     */
    const CASE_FOLDING_NATURAL = "natural";
    const CASE_FOLDING_LOWER   = "lower";
    const CASE_FOLDING_UPPER   = "upper";
    /**#@-*/

    /**#@+
     * Fetch mode constant
     * @var     string
     */
    const FETCH_MODE_LAZY  = "lazy";
    const FETCH_MODE_ASSOC = "assoc";
    const FETCH_MODE_NUM   = "num";
    const FETCH_MODE_BOTH  = "both";
    const FETCH_MODE_NAMED = "named";
    const FETCH_MODE_OBJ   = "obj";
    /**#@-*/

    /**
     * Database params
     * @var     array
     */
    protected $_params = array();

    /**
     * Set the auto quote identifiers flag
     *
     * @param   boolean $autoQuoteIdentifiers
     * @return  Rend_Factory_Database
     */
    public function setAutoQuoteIdentifiers($autoQuoteIdentifiers)
    {
        $this->_params["autoQuoteIdentifiers"] = (boolean) $autoQuoteIdentifiers;
        return $this;
    }

    /**
     * Set the case folding value
     *
     * @param   integer     $caseFolding
     * @return  Rend_Factory_Database
     */
    public function setCaseFolding($caseFolding)
    {
        switch ($caseFolding) {
            case self::CASE_FOLDING_NATURAL:
                $this->_params["caseFolding"] = Zend_Db::CASE_NATURAL;
            break;

            case self::CASE_FOLDING_LOWER:
                $this->_params["caseFolding"] = Zend_Db::CASE_LOWER;
            break;

            case self::CASE_FOLDING_UPPER:
                $this->_params["caseFolding"] = Zend_Db::CASE_UPPER;
            break;
        }
        return $this;
    }

    /**
     * Set the fetch mode
     *
     * @param   string  $fetchMode
     * @return  Rend_Factory_Database_Pdo
     */
    public function setFetchMode($fetchMode)
    {
        switch ($fetchMode) {
            case self::FETCH_MODE_LAZY:
                $this->_params["fetchMode"] = Zend_Db::FETCH_LAZY;
            break;

            case self::FETCH_MODE_ASSOC:
                $this->_params["fetchMode"] = Zend_Db::FETCH_ASSOC;
            break;

            case self::FETCH_MODE_NUM:
                $this->_params["fetchMode"] = Zend_Db::FETCH_NUM;
            break;

            case self::FETCH_MODE_BOTH:
                $this->_params["fetchMode"] = Zend_Db::FETCH_BOTH;
            break;

            case self::FETCH_MODE_NAMED:
                $this->_params["fetchMode"] = Zend_Db::FETCH_NAMED;
            break;

            case self::FETCH_MODE_OBJ:
                $this->_params["fetchMode"] = Zend_Db::FETCH_OBJ;
            break;
        }
        return $this;
    }

    /**
     * Set the host
     *
     * @param   string  $host
     * @return  Rend_Factory_Database
     */
    public function setHost($host)
    {
        $this->_params["host"] = $host;
        return $this;
    }

    /**
     * Set the password
     *
     * @param   string  $password
     * @return  Rend_Factory_Database
     */
    public function setPassword($password)
    {
        $this->_params["password"] = $password;
        return $this;
    }

    /**
     * Set the profiler
     *
     * @param   mixed   $profiler
     * @return  Rend_Factory_Database
     */
    public function setProfiler($profiler)
    {
        $this->_params["profiler"] = $profiler;
        return $this;
    }

    /**
     * Set the schema (aka database name)
     *
     * @param   string  $schema
     * @return  Rend_Factory_Database
     */
    public function setSchema($schema)
    {
        $this->_params["dbname"] = $schema;
        return $this;
    }

    /**
     * Set the username
     *
     * @param   string  $username
     * @return  Rend_Factory_Database
     */
    public function setUsername($username)
    {
        $this->_params["username"] = $username;
        return $this;
    }

}
