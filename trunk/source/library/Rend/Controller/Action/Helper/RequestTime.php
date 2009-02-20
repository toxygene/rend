<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */

/**
 *
 */
class Rend_Controller_Action_Helper_RequestTime extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Proxies to getRequestTime
     *
     * @return Zend_Date
     */
    public function direct()
    {
        return $this->getRequestTime();
    }

    /**
     * Get the current request time
     *
     * @return Zend_Date
     */
    public function getRequestTime()
    {
        return new Zend_Date(
            $this->getRequest()->REQUEST_TIME
        );
    }

}