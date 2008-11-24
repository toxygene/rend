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
 * @category    Rend
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
 * @since       2.0.0
 * @version     $Id$
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 * Model loading helper
 *
 * @category    Rend
 * @package     Controller
 */
class Rend_Controller_Action_Helper_LoadModel extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Database object
     * @var     Zend_Db_Table_Abstract
     */
    protected $_database;

    /**
     * Direct method
     *
     * Load a model by name
     *
     * @param   string                      $name
     * @param   Zend_Db_Adapter_Abstract    $database
     * @return  Zend_Db_Table_Abstract
     */
    public function direct($name)
    {
        return $this->getModel($name);
    }

    /**
     * Load a model by name
     *
     * @param   string                      $name
     * @return  Zend_Db_Table_Abstract
     */
    public function getModel($name)
    {
        if (!$this->_database) {
            /** Zend_Controller_Action_Exception */
            require_once 'Zend/Controller/Action/Exception.php';
            throw new Zend_Controller_Action_Exception("You provide a database object before use");
        }

        // TODO determine loader directories?

        /** Zend_Loader */
        require_once "Zend/Loader.php";

        Zend_Loader::loadClass($name);

        return new $name(array(
            Zend_Db_Table_Abstract::ADAPTER => $this->_database
        ));
    }

    /**
     * Set the database object
     *
     * @param   Zend_Db_Table_Abstract  $database
     * @return  Rend_Controller_Action_Helper_LoadModel
     */
    public function setDatabase(Zend_Db_Adapter_Abstract $database)
    {
        $this->_database = $database;
        return $this;
    }

}
