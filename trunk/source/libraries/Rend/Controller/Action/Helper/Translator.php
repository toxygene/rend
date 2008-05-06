<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Translator extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * Languages directory
     * @var     string
     */
    private $_directory;

    /**
     * Enabled flag
     * @var     boolean
     */
    private $_enabled;

    /**
     * Locale object
     * @var     Zend_Locale
     */
    private $_locale;

    /**
     * Translator object
     * @var     Zend_Translate
     */
    private $_translator;

    /**
     * Constructor
     *
     * @param   string          $directory
     * @param   Zend_Locale     $locale
     */
    public function __construct($directory = null, Zend_Locale $locale = null)
    {
        $this->_directory = $directory;
        $this->_locale    = $locale;
    }

    /**
     *
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
            $path = $this->getFrontController()->getParam('rendPath');
            if (!$path) {
                $path = '..';
            }
            $this->_directory = $path . '/languages';
        }
        return $this->_directory;
    }

    /**
     * Get the locale object
     *
     * @return  Zend_Locale
     */
    public function getLocale()
    {
        if (!$this->_locale) {
            $this->_locale = $this->_getActionHelper('locale')->getLocale();
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
     * Determine if translations are enabled
     *
     * @return  boolean
     */
    public function isEnabled()
    {
        if ($this->_translator) {
            return true;
        } else {
            return $this->_getConfig()->translator && $this->_getConfig()->translator->valid();
        }
    }

}
