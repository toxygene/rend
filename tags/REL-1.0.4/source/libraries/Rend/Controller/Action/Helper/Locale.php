<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Locale extends Rend_Controller_Action_Helper_Abstract implements SplSubject
{

    /**
     * Locale object
     * @var     Zend_Locale
     */
    private $_locale;

    /**
     * Observers
     * @var     array
     */
    private $_observers = array();

    /**
     * Constructor
     *
     * @param   Zend_Locale|string  $locale
     */
    public function __construct($locale = null)
    {
        if ($locale) {
            $this->setLocale($locale);
        }
    }

    /**
     * Attach an observer
     *
     * @param   SplObserver     $observer
     */
    public function attach(SplObserver $observer)
    {
        $this->_observers[] = $observer;
        return $this;
    }

    /**
     * Detach an observer
     *
     * @param   SplObserver     $observer
     */
    public function detach(SplObserver $observer)
    {
        foreach ($this->_observers as &$ob) {
            if ($observer === $ob) {
                unset($ob);
            }
        }
        return $this;
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
     * Notify observers
     */
    public function notify()
    {
        foreach ($this->_observers as &$observer) {
            $observer->update($this);
        }
        return $this;
    }

    /**
     * Set the locale object
     *
     * @param   string|Zend_Locale  $locale
     * @return  Rend_Controller_Action_Helper_Locale
     */
    public function setLocale($locale)
    {
        if ($locale instanceof $locale) {
            $locale = $locale->toString();
        }

        $this->getLocale()->setLocale($locale);
        $this->notify();
        return $this;
    }

}
