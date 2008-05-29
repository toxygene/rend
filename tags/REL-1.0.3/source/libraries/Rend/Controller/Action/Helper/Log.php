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
    private $_log;

    /**
     * Log filename
     * @var     string
     */
    private $_filename;

    /**
     * Construct
     *
     * @param   Zend_Acl    $acl
     * @param   string      $filename
     */
    public function __construct($filename = null) {
        $this->_filename = $filename;
    }

    /**
     * Get the log object
     *
     * @return  Zend_Log
     */
    public function direct()
    {
        return $this->getLog();
    }

    /**
     * Get the log object
     *
     * @return  Zend_Log
     */
    public function getLog()
    {
        if (!$this->_log) {
            /** Zend_Log */
            require_once 'Zend/Log.php';

            $log = new Zend_Log();

            include $this->getFilename();

            $this->_log = $log;
        }
        return $this->_log;
    }

    /**
     * Set the Log object
     *
     * @param   Zend_Log    $log
     * @return  Rend_Controller_Action_Helper_Log
     */
    public function setLog(Zend_Log $log)
    {
        $this->_log = $log;
        return $this;
    }

    /**
     * Get the log config filename
     *
     * @return  string
     */
    public function getFilename()
    {
        if (!$this->_filename) {
            $this->_filename = $this->getFrontController()->getPath() . '/config/log.php';
        }
        return $this->_filename;
    }

}
