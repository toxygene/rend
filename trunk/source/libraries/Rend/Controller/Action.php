<?php
/**
 *
 */

/** Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';

/**
 *
 */
class Rend_Controller_Action extends Zend_Controller_Action
{

    /**
     * Factory
     * @var     Rend_Factory
     */
    protected $_factory;

    /**
     * Initialize the controller
     */
    public function init()
    {
        parent::init();
        $this->_factory = new Rend_Factory($this->getInvokeArg('config')->rend);
    }

}
