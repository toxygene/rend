<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Log extends Rend_Controller_Action_Helper_Abstract
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
            require_once 'Zend/Controller/Action/Exception.php';
            throw new Zend_Controller_Action_Exception('You provide a log object before use');
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
