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

/** Zend_View_Helper_Abstract */
require_once "Zend/View/Helper/Abstract.php";

/**
 * BaseUrl helper
 *
 * @category    Rend
 * @package     View
 */
class Rend_View_Helper_BaseUrl extends Zend_View_Helper_Abstract
{

    /**
     * Get the current base URL
     *
     * @return  string
     */
    public function baseUrl()
    {
        /** Zend_Controller_Front */
        require_once 'Zend/Controller/Front.php';

        return Zend_Controller_Front::getInstance()
                                    ->getRequest()
                                    ->getBaseUrl();
    }

    /**
     * Strategy method
     *
     * @see     baseUrl()
     * @return  string
     */
    public function direct()
    {
        return $this->baseUrl();
    }

}
