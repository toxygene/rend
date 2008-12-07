<?php
/**
 *
 */

/** Rend_Factory_Database_Pdo_Abstract */
require_once "Rend/Factory/Database/Pdo/Abstract.php";

/**
 *
 */
class Rend_Factory_Database_Pdo_Mysql extends Rend_Factory_Database_Pdo_Abstract
{

    /**
     * Create a Mysql Pdo adapter
     *
     * @return Zend_Db_Adapter_Pdo_Mysql
     */
    public function create()
    {
        /** Zend_Db_Adapter_Pdo_Mysql */
        require_once "Zend/Db/Adapter/Pdo/Mysql.php";

        $database = new Zend_Db_Adapter_Pdo_Mysql($this->_options);

        if ($this->_statementClass) {
            $database->setStatementClass($this->_statementClass);
        }

        return $database;
    }

    /**
     * Set the local infile flag
     *
     * @param boolean $allowLocalInfile
     * @return Rend_Factory_Database_Pdo_Mysql
     */
    public function setAllowLocalInfile($allowLocalInfile)
    {
        $this->_options["driverOptions"][PDO::MYSQL_ATTR_LOCAL_INFILE] = $allowLocalInfile;
        return $this;
    }

    /**
     * Set an init command
     *
     * @param string $initCommand
     * @return Rend_Factory_Database_Pdo_Mysql
     */
    public function setInitCommand($initCommand)
    {
        $this->_options["driverOptions"][PDO::MYSQL_ATTR_INIT_COMMAND] = $initCommand;
        return $this;
    }

    /**
     * Set the maximum buffer size
     *
     * @param string $maximumBufferSize
     * @return Rend_Factory_Database_Pdo_Mysql
     */
    public function setMaximumBufferSize($maximumBufferSize)
    {
        $this->_options["driverOptions"][PDO::MYSQL_ATTR_MAX_BUFFER_SIZE] = $maximumBufferSize;
        return $this;
    }

    /**
     * Set the default file to read from
     *
     * @param string $readDefaultFile
     * @return Rend_Factory_Database_Pdo_Mysql
     */
    public function setReadDefaultFile($readDefaultFile)
    {
        $this->_options["driverOptions"][PDO::MYSQL_ATTR_READ_DEFAULT_FILE] = $readDefaultFile;
        return $this;
    }

    /**
     * Set the default group to read from
     *
     * @param string $readDefaultGroup
     * @return Rend_Factory_Database_Pdo_Mysql
     */
    public function setReadDefaultGroup($readDefaultGroup)
    {
        $this->_options["driverOptions"][PDO::MYSQL_ATTR_READ_DEFAULT_GROUP] = $readDefaultGroup;
        return $this;
    }

    /**
     * Set the Unix socket
     *
     * @param string $unixSocket
     * @return Rend_Factory_Database_Pdo_Mysql
     */
    public function setUnixSocket($unixSocket)
    {
        $this->_options["unix_socket"] = $unixSocket;
        return $this;
    }

    /**
     * Set the use buffered queries flag
     *
     * @param boolean $useBufferedQueries
     * @return Rend_Factory_Database_Pdo_Mysql
     */
    public function setUseBufferedQueries($useBufferedQueries)
    {
        $this->_options["driverOptions"][PDO::MYSQL_ATTR_USE_BUFFERED_QUERY] = $useBufferedQueries;
        return $this;
    }

    /**
     * Set the use direct queries flag
     *
     * @param boolean $useDirectQueries
     * @return Rend_Factory_Database_Pdo_Mysql
     */
    public function setUseDirectQueries($useDirectQueries)
    {
        $this->_options["driverOptions"][PDO::MYSQL_ATTR_DIRECT_QUERY] = $useDirectQueries;
        return $this;
    }

}
