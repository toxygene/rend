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
 * @package View
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 1.0.0
 * @version $Id$
 */

/** Zend_Controller_Front */
require_once "Zend/Controller/Front.php";

/** Zend_View_Helper_Abstract */
require_once "Zend/View/Helper/Abstract.php";

/**
 * Url helper
 *
 * Extension of the Zend_View_Helper_Url, adding support for full urls.
 *
 * @category Rend
 * @package View
 */
class Rend_View_Helper_FullUrl extends Zend_View_Helper_Abstract
{

    /**
     * Request object
     * @var Zend_Controller_Request_Abstract
     */
    private $_request;

    /**
     * Determine the full URL based on the the url options
     *
     * @param array $urlOptions
     * @param string $name
     * @param boolean $reset
     * @return string
     */
    public function fullUrl(array $urlOptions = array(), $name = "default", $reset = false)
    {
        $request = $this->_getRequest();

        return $this->_getRequest()->getHttpHost() .
               $this->view->url($urlOptions, $name, $reset);
    }

    /**
     * Strategy method
     *
     * @see fullUrl()
     * @param array $urlOptions
     * @param string $name
     * @param boolean $reset
     * @return string
     */
    public function direct(array $urlOptions = array(), $name = "default", $reset = false)
    {
        return $this->fullUrl($urlOptions, $name, $reset);
    }

    /**
     * Set the request
     *
     * @param Zend_Controller_Request_Http $request
     * @return Rend_View_Helper_FullUrl
     */
    public function setRequest(Zend_Controller_Request_Http $request)
    {
        $this->_request = $request;
        return $this;
    }

    /**
     * Get the request object
     *
     * @return Zend_Controller_Request_Http
     */
    protected function _getRequest()
    {
        if (!$this->_request) {
            /** Zend_Controller_Front */
            require_once "Zend/Controller/Front.php";

            $this->_request = Zend_Controller_Front::getInstance()
                                                   ->getRequest();
        }
        return $this->_request;
    }

}
