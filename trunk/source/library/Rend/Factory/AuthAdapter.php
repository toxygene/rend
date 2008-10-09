<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_AuthAdapter_Interface */
require_once 'Rend/Factory/AuthAdapter/Interface.php';

/**
 *
 */
class Rend_Factory_AuthAdapter extends Rend_Factory_Abstract implements Rend_Factory_AuthAdapter_Interface
{

    /**
     * @var     string
     */
    protected $_adapter;

    /**
     * @var     array
     */
    protected $_options;

    /**
     * Get an auth object
     *
     * @return  Zend_Auth_Adapter_Interface
     */
    public function create()
    {
        $adapter = 'authAdapter' . ucWords($this->_adapter);

        return $this->_factoryLoader
                    ->$adapter();
    }

    /**
     *
     */
    public function setAdapter($adapter)
    {
        $this->_adapter = $adapter;
        return $this;
    }

}
