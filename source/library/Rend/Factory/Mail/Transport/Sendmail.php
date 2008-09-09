<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Zend_Mail_Transport_Sendmail */
require_once 'Zend/Mail/Transport/Sendmail.php';

/**
 *
 */
class Rend_Factory_Mail_Transport_Sendmail extends Rend_Factory_Abstract
{

    /**
     * Get a mail transport object
     *
     * @return  Zend_Mail_Transport_Sendmail
     */
    public function create()
    {
        return new Zend_Mail_Transport_Sendmail(
            $this->getParameters()
        );
    }

}
