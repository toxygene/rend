<?php
/**
 *
 */

/**
 *
 */
interface Rend_Base_Interface
{

    /**
     * Constructor
     *
     * @param array|Zend_Config $config
     */
    public function __construct($config = null);

    /**
     *
     */
    public function setConfig(Zend_Config $config);

    /**
     *
     */
    public function setOptions(array $options);

    /**
     *
     */
    protected function _init();

}