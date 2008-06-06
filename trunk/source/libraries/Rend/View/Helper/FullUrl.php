<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     View
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Rend_View_Helper */
require_once 'Rend/View/Helper.php';

/**
 * Url helper
 *
 * Extension of the Zend_View_Helper_Url, adding support for full urls.
 *
 * @category    Rend
 * @package     View
 */
class Rend_View_Helper_FullUrl extends Rend_View_Helper
{

    /**
     * Determine the full URL based on the the url options
     *
     * @param   array       $urlOptions
     * @param   string      $name
     * @param   boolean     $reset
     * @return  string
     */
    public function fullUrl(array $urlOptions = array(), $name = 'default', $reset = false)
    {
        /** Rend_Controller_Front */
        require_once 'Rend/Controller/Front.php';
        $request = Rend_Controller_Front::getInstance()->getRequest();

        if ($this->_isHttps()) {
            $url = 'https://';
        } else {
            $url = 'http://';
        }

        $url .= $request->SERVER_NAME;

        if (($this->_isHttps() && $request->SERVER_PORT != 443) || (!$this->_isHttps() && $request->SERVER_PORT != 80)) {
            $url .= ':' . $request->SERVER_PORT;
        }

        return $url . $this->getView()->url($urlOptions, $name, $reset);
    }

    /**
     * Determine if the request is a SSL request
     *
     * @return  boolean
     */
    private function _isHttps()
    {
        /** Rend_Controller_Front */
        require_once 'Rend/Controller/Front.php';
        return Rend_Controller_Front::getInstance()->getRequest()->isSsl();
    }

}
