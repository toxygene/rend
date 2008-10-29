<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 * Locale helper
 *
 * @category    Rend
 * @package     Controller
 */
class Rend_Controller_Action_Helper_Locale extends Zend_Controller_Action_Helper_Abstract implements SplSubject
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
            require_once "Zend/Locale.php";
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
