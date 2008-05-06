<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Locale extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Locale object
     * @var     Zend_Locale
     */
    private $_locale;

    /**
     *
     */
    public function __construct($locale = null)
    {
    }

    /**
     * Get the locale object
     *
     * @return  Zend_Locale
     */
    public function direct()
    {
        return $this->getLocale();
    }

    /**
     * Get the locale object
     *
     * @return  Zend_Locale
     */
    public function getLocale()
    {
        if (!$this->_locale) {
            /** Zend_Locale */
            require_once 'Zend/Locale.php';
            $this->_locale = new Zend_Locale();
        }
        return $this->_locale;
    }

    /**
     * Set the locale object
     *
     * @param   Zend_Locale     $locale
     * @return  Rend_Controller_Action_Helper_Locale
     */
    public function setLocale(Zend_Locale $locale)
    {
        $this->_locale = $locale;
        return $this;
    }

}
