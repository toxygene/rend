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
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Factory_Database_Abstract */
require_once "Rend/Factory/Database/Abstract.php";

/** Zend_Db_Adapter_Mysqli */
require_once "Zend/Db/Adapter/Mysqli.php";

/**
 * @category Rend
 * @package Factory
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
        $database = new Zend_Db_Adapter_Mysqli($this->_options);

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
