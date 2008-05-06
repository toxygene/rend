<?php
/**
 *
 */

/** Zend_Db_Table_Abstract */
require_once 'Zend/Db/Table/Abstract.php';

/**
 *
 */
abstract class Project_Db_Table extends Zend_Db_Table_Abstract
{

    /**
     * Row class name
     * @var     string
     */
    protected $_rowClass = 'Project_Db_Row';

    /**
     * Rowset class name
     * @var     string
     */
    protected $_rowsetClass = 'Project_Db_Rowset';

}
