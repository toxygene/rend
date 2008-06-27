<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Translator extends Rend_Controller_Action_Helper_Abstract implements SplObserver
{

    /**
     * Languages directory
     * @var     string
     */
    private $_directory;

    /**
     * Translator object
     * @var     Zend_Translate_Adapter
     */
    private $_translator;

    /**
     * Constructor
     *
     * @param   string          $directory
     * @param   Zend_Locale     $locale
     */
    public function __construct($directory = null, $locale = null)
    {
        $this->_directory = $directory;
        $this->_locale    = $locale;
    }

    /**
     * Get the translator
     *
     * @return  Zend_Translator_Adapter
     */
    public function direct()
    {
        return $this->getTranslator();
    }

    /**
     * Get the languages directory
     *
     * @return  string
     */
    public function getDirectory()
    {
        if (!$this->_directory) {
            $this->_directory = $this->getFrontController()->getPath() . '/languages';
        }
        return $this->_directory;
    }

    /**
     *
     */
    public function getLocale()
    {
        if (!$this->_locale) {
            $this->_locale = $this->_getActionHelper('locale')->getLocale();
            $this->_getActionHelper('locale')->attach($this);
        }
        return $this->_locale;
    }

    /**
     * Get the translate object
     *
     * @return  Zend_Translate
     */
    public function getTranslator()
    {
        if (!$this->_translator) {
            if (!$this->isEnabled()) {
                /** Zend_Controller_Action_Exception */
                require_once 'Zend/Controller/Action/Exception.php';
                throw new Zend_Controller_Action_Exception('Translations are not enabled');
            }

            $config = $this->_getConfig()->translator;

            /** Zend_Translate */
            require_once 'Zend/Translate.php';

            $options = array(
                'scan' => Zend_Translate::LOCALE_DIRECTORY
            );

            if (isset ($config->options)) {
                $options = array_merge(
                    $options,
                    $config->options->toArray()
                );
            }

            $this->_translator = new Zend_Translate(
                $config->adapter,
                $this->getDirectory(),
                null,
                $options
            );

            $this->_translator->setLocale($this->getLocale());
        }

        return $this->_translator;
    }

    /**
     * Determine if translations are enabled
     *
     * @return  boolean
     */
    public function isEnabled()
    {
        return (boolean) $this->_translator || ($this->_getConfig()->translator && $this->_getConfig()->translator->valid());
    }

    /**
     * Set the translate object
     *
     * @param   Zend_Translate  $translator
     * @return  Rend_Controller_Action_Helper_Translate
     */
    public function setTranslator(Zend_Translate $translator)
    {
        $this->_translator = $translator;
        return $this;
    }

    /**
     * Update based on an observer
     *
     * @param   SplSubject  $subject
     */
    public function update(SplSubject $subject)
    {
        $this->getTranslator()->setLocale($subject->getLocale());
    }

}
