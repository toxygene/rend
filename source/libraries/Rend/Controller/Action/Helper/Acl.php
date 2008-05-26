<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Acl extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * ACL object
     * @var     Zend_Acl
     */
    private $_acl;

    /**
     * ACL filename
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
     * Get the ACL object
     *
     * @return  Zend_Acl
     */
    public function direct()
    {
        return $this->getAcl();
    }

    /**
     * Get the ACL object
     *
     * @return  Zend_Acl
     */
    public function getAcl()
    {
        if (!$this->_acl) {
            /** Zend_Acl */
            require_once 'Zend/Acl.php';

            /** Zend_Acl_Role */
            require_once 'Zend/Acl/Role.php';

            /** Zend_Acl_Resource */
            require_once 'Zend/Acl/Resource.php';

            $acl = new Zend_Acl();

            /** Acl rules */
            include $this->getFilename();

            $this->_acl = $acl;
        }
        return $this->_acl;
    }

    /**
     * Set the ACL object
     *
     * @param   Zend_Acl $acl
     * @return  Rend_Controller_Action_Helper_Acl
     */
    public function setAcl(Zend_Acl $acl)
    {
        $this->_acl = $acl;
        return $this;
    }

    /**
     * Get the ACL config filename
     *
     * @return  string
     */
    public function getFilename()
    {
        if (!$this->_filename) {
            $this->_filename = $this->getFrontController()->getParam('rendPath') . '/config/acl.php';
        }
        return $this->_filename;
    }

}
