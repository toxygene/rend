<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Zend_Translate */
require_once 'Zend/Translate.php';

/**
 *
 */
class Rend_Factory_Translator extends Rend_Factory_Abstract
{

    /**
     * Adapter type
     * @var     string
     */
    private $_adapter;

    /**
     *
     */
    public function create()
    {
        return new Zend_Translate(
            $this->getAdapter()
        );
    }

    /**
     * Get the translate adapter type
     *
     * @return  string
     */
    public function getAdapter()
    {
        return $this->_adapter;
    }

}
