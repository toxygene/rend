<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/** Zend_View */
require_once 'Zend/View.php';

/**
 *
 */
class Rend_Controller_Action_Helper_View extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * Default encoding
     * @var     string
     */
    const DEFAULT_ENCODING = 'UTF-8';

    /**
     * Encoding
     */
    private $_encoding;

    /**
     * Rend view helpers path
     * @var     string
     */
    private $_path;

    /**
     * Translator object
     * @var     Zend_Translate
     */
    private $_translator;

    /**
     * Construct
     *
     * @param   string          $encoding
     * @param   string          $path
     * @param   Zend_Translate  $translator
     */
    public function __construct($encoding = null, $path = null, Zend_Translate $translator = null)
    {
        $this->_encoding   = $encoding;
        $this->_path       = $path;
        $this->_translator = $translator;
    }

    /**
     * Get the view object
     *
     * @return  Zend_View
     */
    public function direct()
    {
        return $this->getView();
    }

    /**
     * Get the encoding
     *
     * @return  string
     */
    public function getEncoding()
    {
        if (!$this->_encoding) {
            $this->_encoding = $this->_getConfig()->encoding;
            if (!$this->_encoding) {
                $this->_encoding = self::DEFAULT_ENCODING;
            }
        }
        return $this->_encoding;
    }

    /**
     * Get the Rend view helper path
     *
     * @return  string
     */
    public function getPath()
    {
        if (!$this->_path) {
            $path = $this->getFrontController()->getParam('rendPath');
            if (!$path) {
                $path = '.';
            }
            $this->_path = $path . '/libraries/Rend/View/Helper';
        }
        return $this->_path;
    }

    /**
     * Get the translate object
     *
     * @return  Zend_Translate
     * @todo    This could use some kind of alternative
     */
    public function getTranslator()
    {
        if (!$this->_translator) {
            $this->_translator = $this->_getActionHelper('translator')->getTranslator();
        }
        return $this->_translator;
    }

    /**
     * Get the view object
     *
     * @return  Zend_View
     */
    public function getView()
    {
        $view = new Zend_View(array(
            'encoding'         => $this->getEncoding(),
            'helperPath'       => $this->getPath(),
            'helperPathPrefix' => 'Rend_View_Helper'
        ));

        if ($this->_translator || $this->_getActionHelper('translator')->isEnabled()) {
            $view->getHelper('translate')->setTranslator($this->getTranslator());
        }

        return $view;
    }

}
