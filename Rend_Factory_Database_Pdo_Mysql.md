# Description #
This class is an [Abstract Factory](http://en.wikipedia.org/wiki/Abstract_factory_pattern) for the [pdo\_mysql](http://php.net/pdo_mysql) [Zend\_Db\_Adapter](http://framework.zend.com/manual/en/zend.db.html#zend.db.adapter).

# API #
| **Method** | **Description** |
|:-----------|:----------------|
| `__construct(/* array | Zend_Config */ $options)` | A Zend\_Config object or array matching the setter names |
| `create()` | Create an instance of a [Zend\_Db\_Adapter](http://framework.zend.com/manual/en/zend.db.html#zend.db.adapter) class |
| `setAllowLocalInfile(/* boolean */ $allowLocalInfile)` | Enables `LOAD LOCAL INFILE`. |
| `setCharset(/* string */ $charset)` | Sets the connection charset by issuing a `"SET NAMES ?"` query upon connection. |
| `setInitCommand(/* string */ $initCommand)` | Sets a query to be immediately issues upon connection to the database. |
| `setMaximumBufferSize(/* integer */ $maximumBufferSize)` | Sets the maximum buffer size for queries. |
| `setReadDefaultFile(/* string */ $readDefaultFile)` |  |
| `setReadDefaultGroup(/* string */ $readDefaultGroup)` |  |
| `setUnixSocket(/* string */ $unixSocket)` |  |
| `setUseBufferedQueries(/* boolean */ $useBufferedQueries)` |  |
| `setUseDirectQueries(/* boolean */ $useDirectQueries)` |  |

# Examples #
## Basic ##
Basic usage of the `Rend_Factory_Database_Pdo_Mysql` is to create an instance of the factory and call it's `create()` method on demand.

```
class MyController extends Rend_Controller_Action {
    protected $_database;
    public function init() {
        $factory = new Rend_Factory_Database_Pdo_Mysql(array(
            'host'             => 'localhost',
            'username'         => 'test',
            'password'         => 'test',
            'dbname'           => 'database',
            'charset'          => 'utf8',
            'allowLocalInfile' => true
        ));
        $this->_database = $factory->create();
    }
}
```