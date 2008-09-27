<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_View_Interface */
require_once 'Rend/Factory/View/Interface.php';

/** Zend_View */
require_once 'Zend/View.php';

/**
 *
 */
class Rend_Factory_View extends Rend_Factory_Abstract implements Rend_Factory_View_Interface
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
     *
     */
    public function create()
    {
        $config = array();

        if ($this->_basePath) {
            $config['basePath'] = $this->_basePath;
        }

        if ($this->_encoding) {
            $config['encoding'] = $this->_encoding;
        }

        if ($this->_escape) {
            $config['escape'] = $this->_escape;
        }

        if ($this->_filter) {
            $config['filter'] = $this->_filter;
        }

        if ($this->_filterPath) {
            $config['filterPath'] = $this->_filterPath;
        }

        if ($this->_helperPath) {
            $config['helperPath'] = $this->_helperPath;
        }

        if ($this->_scriptPath) {
            $config['scriptPath'] = $this->_scriptPath;
        }

        if ($this->_strictVars) {
            $config['strictVars'] = $this->_strictVars;
        }

        $view = new Zend_View($config);

        if ($this->_doctype) {
            $view->getHelper('Doctype')
                 ->setDoctype($this->_doctype);
        }

        return $view;
    }

    /**
     *
     */
    public function setDoctype($doctype)
    {
        $this->_doctype = $doctype;
        return $this;
    }

    /**
     *
     */
    public function setEncoding($encoding)
    {
        $this->_encoding = $encoding;
        return $this;
    }

}
