<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
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
            throw new Zend_Controller_Action_Exception('You must provide an acl object before use');
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
