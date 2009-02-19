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
 * @package Controller
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 * Model loading helper
 *
 * @category Rend
 * @package Controller
 */
class Rend_Controller_Action_Helper_LoadModel extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * Database object
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_database;

    /**
     * Direct method
     *
     * Load a model by name
     *
     * @param string $name
     * @param Zend_Db_Adapter_Abstract $database
     * @return Zend_Db_Table_Abstract
     */
    public function direct($name, Zend_Db_Adapter_Abstract $database = null)
    {
        return $this->getModel(
            $name,
            $database
        );
    }

    /**
     * Get the database object
     *
     * @return Zend_Db_Adapter_Abstract
     * @throws Zend_Controller_Action_Exception
     */
    public function getDatabase()
    {
        if ($this->_database) {
            return $this->_database;
        }

        if ($this->getFactoryLoader() &&
            isset($this->getFactoryLoader()->database) &&
            $this->getFactoryLoader()->database instanceof Rend_Factory_Database_Interface) {
            return $this->getFactoryLoader()->database();
        }

        return null;
    }

    /**
     * Load a model by name
     *
     * @param string $name
     * @param Zend_Db_Adapter_Abstract $database
     * @return Zend_Db_Table_Abstract
     */
    public function getModel($name, Zend_Db_Adapter_Abstract $database = null)
    {
        if (!$database) {
            $database = $this->getDatabase();
        }

        $config = array();

        if ($database) {
            $config[Zend_Db_Table_Abstract::ADAPTER] = $database;
        }

        return new $name($config);
    }

    /**
     * Set the database object
     *
     * @param Zend_Db_Table_Abstract $database
     * @return Rend_Controller_Action_Helper_LoadModel
     */
    public function setDatabase(Zend_Db_Adapter_Abstract $database)
    {
        $this->_database = $database;
        return $this;
    }

}
