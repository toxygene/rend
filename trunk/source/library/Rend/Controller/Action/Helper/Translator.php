<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Translate extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Translator object
     * @var     Zend_Translator_Adapter
     */
    protected $_translator;

    /**
     * Translate a message
     *
     * @param   string      $messageId
     * @param   integer     $locale
     * @param   string
     */
    public function direct($messageId, $locale = null)
    {
        if (!$this->_translator) {
            /** Zend_Controller_Action_Exception */
            require_once 'Zend/Controller/Action/Exception.php';
            throw new Zend_Controller_Action_Exception('You provide a translator object before use');
        }

        return $this->_translator
                    ->translate($messageId, $locale);
    }

    /**
     * Set the translator object
     *
     * @param   Zend_Translator_Adapter     $translator
     * @return  Rend_Controller_Action_Helper_Translate
     */
    public function setTranslator(Zend_Translator_Adapter $translator)
    {
        $this->_translator = $translator;
        return $this;
    }

}
