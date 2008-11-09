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
    protected $_basePath;

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
    protected $_filter;

    /**
     *
     */
    protected $_filterPath;

    /**
     *
     */
    protected $_helperPath;

    /**
     *
     */
    protected $_scriptPath;

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
        $config = array();

        if ($this->_basePath) {
            $config["basePath"] = $this->_basePath;
        }

        if ($this->_encoding) {
            $config["encoding"] = $this->_encoding;
        }

        if ($this->_escape) {
            $config["escape"] = $this->_escape;
        }

        if ($this->_filter) {
            $config["filter"] = $this->_filter;
        }

        if ($this->_filterPath) {
            $config["filterPath"] = $this->_filterPath;
        }

        if ($this->_helperPath) {
            $config["helperPath"] = $this->_helperPath;
        }

        if ($this->_scriptPath) {
            $config["scriptPath"] = $this->_scriptPath;
        }

        if ($this->_strictVars) {
            $config["strictVars"] = $this->_strictVars;
        }

        $view = new Zend_View($config);

        if ($this->_doctype) {
            $view->getHelper("Doctype")
                 ->setDoctype($this->_doctype);
        }

        return $view;
    }

    /**
     * Set the base path
     *
     * @param   string  $basePath
     * @return  Rend_Factory_View
     */
    public function setBasePath($basePath)
    {
        $this->_basePath = $basePath;
        return $this;
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
     * Set the filter
     *
     * @param   string  $filter
     * @return  Rend_Factory_View
     */
    public function setFilter($filter)
    {
        $this->_filter = $filter;
        return $this;
    }

    /**
     * Set the filter path
     *
     * @param   string  $filterPath
     * @return  Rend_Factory_View
     */
    public function setFilterPath($filterPath)
    {
        $this->_filterPath = $filterPath;
        return $this;
    }

    /**
     * Set the helper path
     *
     * @param   string  $helperPath
     * @return  Rend_Factory_View
     */
    public function setHelperPath($helperPath)
    {
        $this->_helperPath = $helperPath;
        return $this;
    }

    /**
     * Set the script path
     *
     * @param   string  $scriptPath
     * @return  Rend_Factory_View
     */
    public function setScriptPath($scriptPath)
    {
        $this->_scriptPath = $scriptPath;
        return $this;
    }

    /**
     * Set the strict vars flag
     *
     * @param   boolean     $strictVars\
     * @return  Rend_Factory_View
     */
    public function setStrictVars($strictVars)
    {
        $this->_strictVars = (boolean) $strictVars;
        return $this;
    }

}
