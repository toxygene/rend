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
 * @version $Id: LoadModel.php 495 2009-02-19 20:59:58Z justin.hendrickson $
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 * Helper for getting the request time from the request
 *
 * @category Rend
 * @package Controller
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