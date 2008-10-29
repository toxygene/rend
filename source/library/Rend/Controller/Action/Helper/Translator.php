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
 * @since       2.0.0
 * @version     $Id$
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 * Model loading helper
 *
 * @category    Rend
 * @package     Controller
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
            require_once "Zend/Controller/Action/Exception.php";
            throw new Zend_Controller_Action_Exception("You provide a translator object before use");
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
