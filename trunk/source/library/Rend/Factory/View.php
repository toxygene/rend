<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Zend_View */
require_once "Zend/View.php";

/**
 *
 */
class Rend_Factory_View extends Rend_FactoryLoader_Factory_Abstract
{

    /**
     *
     */
    protected $_doctype;

    /**
     *
     */
    protected $_encoding;

    /**
     *
     */
    protected $_escape;

    /**
     *
     */
    protected $_filterPaths;

    /**
     *
     */
    protected $_helperPaths;

    /**
     *
     */
    protected $_scriptPaths;

    /**
     *
     */
    protected $_strictVars;

    /**
     * Create a view object
     *
     * @return  Zend_View
     */
    public function create()
    {
        $view = new Zend_View();

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
                    $view->addFilterPath($filterPath['path'], $filterPath['prefix']);
                } else {
                    $view->addFilterPath($filterPath);
                }
            }
        }

        if ($this->_helperPaths) {
            foreach ($this->_helperPaths as $helperPath) {
                if (is_array($helperPath)) {
                    $view->addHelperPath($helperPath['path'], $helperPath['prefix']);
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
            $view->setStrictVars($this->_strictVars);
        }

        return $view;
    }

    /**
     * Set the doctype
     *
     * @param   string  $doctype
     * @return  Rend_Factory_View
     *
     */
    public function setDoctype($doctype)
    {
        $this->_doctype = $doctype;
        return $this;
    }

    /**
     * Set the encoding
     *
     * @param   string  $encoding
     * @return  Rend_Factory_View
     */
    public function setEncoding($encoding)
    {
        $this->_encoding = $encoding;
        return $this;
    }

    /**
     * Set the escape method
     *
     * @param   mixed   $escape
     * @return  Rend_Factory_View
     */
    public function setEscape($escape)
    {
        $this->_escape = $escape;
        return $this;
    }

    /**
     * Set the filter paths
     *
     * @param	array 	$filterPaths
     * @return	Rend_Filter_View
     */
    public function setFilterPaths($filterPaths)
    {
        $this->_filterPaths = $filterPaths;
        return $this;
    }

    /**
     * Set the helper paths
     *
     * @param	array 	$helperPaths
     * @return	Rend_Factory_View
     */
    public function setHelperPaths($helperPaths)
    {
        $this->_helperPaths = $helperPaths;
        return $this;
    }

    /**
     * Set the script paths
     *
     * @param	array	$scriptPaths
     * @return	Rend_Factory_View
     */
    public function setScriptPaths($scriptPaths)
    {
        $this->_scriptPaths = $scriptPaths;
        return $this;
    }

    /**
     * Set the strict vars flag
     *
     * @param   boolean     $strictVars
     * @return  Rend_Factory_View
     */
    public function setStrictVars($strictVars)
    {
        $this->_strictVars = (boolean) $strictVars;
        return $this;
    }

}
