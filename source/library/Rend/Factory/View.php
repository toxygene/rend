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
 * @category Rend
 * @package Factory
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Base_Abstract */
require_once "Rend/Base/Abstract.php";

/** Rend_Factory_View_Interface */
require_once "Rend/Factory/View/Interface.php";

/**
 * @category Rend
 * @package Factory
 */
class Rend_Factory_View extends Rend_Base_Abstract implements Rend_Factory_View_Interface
{

    /**
     * Doctype
     * @var string
     */
    protected $_doctype;

    /**
     * Encoding
     * @var string
     */
    protected $_encoding;

    /**
     * Escape
     * @var string
     */
    protected $_escape;

    /**
     * Filter paths
     * @var array
     */
    protected $_filterPaths;

    /**
     * Helper paths
     * @var array
     */
    protected $_helperPaths;

    /**
     * Disable LFI protection flag
     * @var boolean
     */
    protected $_disableLfiProtection;

    /**
     * Script paths
     * @var array
     */
    protected $_scriptPaths;

    /**
     * Strict vars
     * @var boolean
     */
    protected $_strictVars;

    /**
     * Create a view object
     *
     * @return Zend_View
     */
    public function create()
    {
        /** Zend_View */
        require_once "Zend/View.php";

        $view = new Zend_View();

        $view->addHelperPath(
            "Rend/View/Helper",
            "Rend_View_Helper"
        );

        if ($this->_doctype) {
            $view->getHelper("Doctype")
                 ->setDoctype($this->_doctype);
        }

        if ($this->_encoding) {
            $view->setEncoding($this->_encoding);
        }

        if ($this->_escape) {
            $view->setEscape($this->_escape);
        }

        if ($this->_filterPaths) {
            foreach ($this->_filterPaths as $filterPath) {
                if (is_array($filterPath)) {
                    if (isset($filterPath["prefix"])) {
                        $view->addFilterPath($filterPath["path"], $filterPath["prefix"]);
                    } else {
                        $view->addFilterPath($filterPath["path"]);
                    }
                } else {
                    $view->addFilterPath($filterPath);
                }
            }
        }

        if ($this->_helperPaths) {
            foreach ($this->_helperPaths as $helperPath) {
                if (is_array($helperPath)) {
                    if (isset($helperPath["prefix"])) {
                        $view->addHelperPath($helperPath["path"], $helperPath["prefix"]);
                    } else {
                        $view->addHelperPath($helperPath["path"]);
                    }
                } else {
                    $view->addHelperPath($helperPath);
                }
            }
        }

        if ($this->_scriptPaths) {
            foreach ($this->_scriptPaths as $scriptPath) {
                $view->addScriptPath($scriptPath);
            }
        }

        if ($this->_strictVars) {
            $view->strictVars($this->_strictVars);
        }

        if ($this->_disableLfiProtection) {
            $view->setLfiProtectionOn(false);
        }

        return $view;
    }

    /**
     * Set the doctype
     *
     * @param string $doctype
     * @return Rend_Factory_View
     */
    public function setDoctype($doctype)
    {
        $this->_doctype = $doctype;
        return $this;
    }

    /**
     * Set the encoding
     *
     * @param string $encoding
     * @return Rend_Factory_View
     */
    public function setEncoding($encoding)
    {
        $this->_encoding = $encoding;
        return $this;
    }

    /**
     * Set the escape method
     *
     * @param mixed $escape
     * @return Rend_Factory_View
     */
    public function setEscape($escape)
    {
        $this->_escape = $escape;
        return $this;
    }

    /**
     * Set the filter paths
     *
     * @param array $filterPaths
     * @return Rend_Factory_View
     */
    public function setFilterPaths($filterPaths)
    {
        $this->_filterPaths = $filterPaths;
        return $this;
    }

    /**
     * Set the helper paths
     *
     * @param array $helperPaths
     * @return Rend_Factory_View
     */
    public function setHelperPaths($helperPaths)
    {
        $this->_helperPaths = $helperPaths;
        return $this;
    }

    /**
     * Set the LFI protection flag
     *
     * @param boolean $disableLfiProtection
     * @return Rend_Factory_View
     */
    public function setDisableLfiProtection($disableLfiProtection)
    {
        $this->_disableLfiProtection = $disableLfiProtection;
        return $this;
    }

    /**
     * Set the script paths
     *
     * @param array $scriptPaths
     * @return Rend_Factory_View
     */
    public function setScriptPaths($scriptPaths)
    {
        $this->_scriptPaths = $scriptPaths;
        return $this;
    }

    /**
     * Set the strict vars flag
     *
     * @param boolean $strictVars
     * @return Rend_Factory_View
     */
    public function setStrictVars($strictVars)
    {
        $this->_strictVars = (boolean) $strictVars;
        return $this;
    }

}
