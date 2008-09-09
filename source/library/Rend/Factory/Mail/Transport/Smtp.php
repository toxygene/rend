<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Zend_Mail_Transport_Smtp */
require_once 'Zend/Mail/Transport/Smtp.php';

/**
 *
 */
class Rend_Factory_Mail_Transport_Smtp extends Rend_Factory_Abstract
{

    /**
     * Get a mail transport object
     *
     * @return  Zend_Mail_Transport_Smtp
     */
    public function create()
    {
        return new Zend_Mail_Transport_Smtp(
            $this->getHost(),
            $this->getOptions()
        );
    }

    /**
     * Get the host name
     *
     * @return  string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * Get the options
     *
     * @return  array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Set the host name
     * 
     * @param   string  $host
     * @return  Zend_Mail_Transport_Smtp
     */
    public function setHost($host)
    {
        $this->_host = $host;
        return $this;
    }

    /**
     * Set the options
     *
     * @param   array   $options
     * @return  Zend_Mail_Transport_Smtp
     */
    public function setOptions(array $options)
    {
        $this->_options = $options;
        return $this;
    }

}
