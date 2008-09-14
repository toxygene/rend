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
 * BaseUrl helper
 *
 * @category    Rend
 * @package     View
 */
class Rend_View_Helper_BaseUrl extends Rend_View_Helper
{

    /**
     * Get the current base URL
     *
     * @return  string
     */
    public function baseUrl()
    {
        return Rend_Controller_Front::getInstance()->getRequest()->getBaseUrl();
    }

}