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
 * @package     View
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
 * @since       1.0.0
 * @version     $Id$
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
 * @category    Rend
 * @package     View
 */
class Rend_View_Helper_FullUrl extends Zend_View_Helper_Abstract
{

    /**
     * Determine the full URL based on the the url options
     *
     * @param   array       $urlOptions
     * @param   string      $name
     * @param   boolean     $reset
     * @return  string
     */
    public function fullUrl(array $urlOptions = array(), $name = "default", $reset = false)
    {
        $request = Zend_Controller_Front::getInstance()
                                        ->getRequest();

        if ($request->isSecure()) {
            $url = "https://";
        } else {
            $url = "http://";
        }

        $url .= $request->SERVER_NAME;

        if (($request->isSecure() && $request->SERVER_PORT != 443) || (!$request->isSecure() && $request->SERVER_PORT != 80)) {
            $url .= ":{$request->SERVER_PORT}";
        }

        return $url . $this->view>url($urlOptions, $name, $reset);
    }

    /**
     * Strategy method
     *
     * @see     fullUrl()
     * @param   array       $urlOptions
     * @param   string      $name
     * @param   boolean     $reset
     * @return  string
     */
    public function direct(array $urlOptions = array(), $name = "default", $reset = false)
    {
        return $this->fullUrl($urlOptions, $name, $reset);
    }

}
