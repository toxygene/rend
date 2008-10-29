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
 * Acl permission check helper
 *
 * @category    Rend
 * @package     Controller
 */
class Rend_Controller_Action_Helper_CheckPermissions extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Zend_Acl object
     * @var Zend_Acl
     */
    protected $_acl;

    /**
     * Check a roles resource/permissions
     *
     * @return  boolean
     */
    public function direct($role, $resource, $permission = null)
    {
        if (!$this->_acl) {
            /** Zend_Controller_Action_Exception */
            require_once 'Zend/Controller/Action/Exception.php';
            throw new Zend_Controller_Action_Exception("You must provide an acl object before use");
        }

        return $this->_acl
                    ->isAllowed($role, $resource, $permission);
    }

    /**
     * Set the Zend_Acl object
     *
     * @param   Zend_Acl    $acl
     * @return  Rend_Controller_Action_Helper_CheckPermissions
     */
    public function setAcl(Zend_Acl $acl)
    {
        $this->_acl = $acl;
        return $this;
    }

}
