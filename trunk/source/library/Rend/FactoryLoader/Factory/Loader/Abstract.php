<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once 'Rend/FactoryLoader/Factory/Abstract.php';

/** Rend_FactoryLoader_Factory_Loader_Interface */
require_once 'Rend/FactoryLoader/Factory/Loader/Interface.php';

/**
 *
 */
abstract class Rend_FactoryLoader_Factory_Loader_Abstract extends Rend_FactoryLoader_Factory_Abstract implements Rend_FactoryLoader_Factory_Loader_Interface
{

    /**
     *
     */
    protected $_factoryLoader;

    /**
     *
     */
    public function setFactoryLoader(Rend_FactoryLoader $factoryLoader)
    {
        $this->_factoryLoader = $factoryLoader;
        return $this;
    }

}
