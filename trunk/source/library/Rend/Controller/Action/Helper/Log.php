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
class Rend_Controller_Action_Helper_Log extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Log object
     * @var     Zend_Log
     */
    protected $_log;

    /**
     * Log a message
     *
     * @param   string      $message
     * @param   integer     $level
     * @return  Rend_Controller_Action_Helper_Log
     */
    public function direct($message, $level)
    {
        if (!$this->_log) {
            /** Zend_Controller_Action_Exception */
            require_once "Zend/Controller/Action/Exception.php";
            throw new Zend_Controller_Action_Exception("You provide a log object before use");
        }

        $this->_log
             ->create()
             ->log($message, $level);

        return $this;
    }

    /**
     * Set the log object
     *
     * @param   Zend_Log    $log
     * @return  Rend_Controller_Action_Helper_Log
     */
    public function setLog(Zend_Log $log)
    {
        $this->_log = $log;
        return $this;
    }

}
