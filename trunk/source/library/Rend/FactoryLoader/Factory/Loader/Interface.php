<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Interface */
require_once 'Rend/FactoryLoader/Factory/Interface.php';

/**
 *
 */
interface Rend_FactoryLoader_Factory_Loader_Interface extends Rend_FactoryLoader_Factory_Interface
{

    /**
     *
     */
    public function setFactoryLoader(Rend_FactoryLoader $factoryLoader);

}
