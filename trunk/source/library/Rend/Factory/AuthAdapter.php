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
    protected $_options = array();

    /**
     * Get an auth object
     *
     * @return  Zend_Auth_Adapter_Interface
     */
    public function create()
    {
        $adapter = 'AuthAdapter_' . ucWords($this->_adapter);

        return $this->_factoryLoader
                    ->$adapter
                    ->setOptions($this->_options)
                    ->create();
    }

    /**
     *
     */
    public function setAdapter($adapter)
    {
        $this->_adapter = $adapter;
        return $this;
    }

    /**
     *
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . ucFirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            } else {
                $this->_options[$key] = $value;
            }
        }
        return $this;
    }

}