<?php
/**
 *
 */

/** Rend_Factory_Database_Abstract */
require_once "Rend/Factory/Database/Abstract.php";

/** Zend_Db_Adapter_Mysqli */
require_once "Zend/Db/Adapter/Mysqli.php";


/**
 *
 */
class Rend_Factory_Database_Mysqli extends Rend_Factory_Database_Abstract
{

    /**
     * Charset
     * @var string
     */
    protected $_charset;

    /**
     * Create a Mysqli adapter
     *
     * @return Zend_Db_Adapter_Mysqli
     */
    public function create()
    {
        $database = new Zend_Db_Adapter_Mysqli($this->_params);

        if ($this->_statementClass) {
            $database->setStatementClass($this->_statementClass);
        }

        if ($this->_charset) {
            $database->getConnection()
                     ->set_charset($this->_charset);
        }

        return $database;
    }

    /**
     * Set the charset
     *
     * @param string $charset
     * @return Rend_Factory_Database_Pdo_Mysql
     */
    public function setCharset($charset)
    {
        $this->_charset = $charset;
        return $this;
    }

}
