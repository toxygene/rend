# Description #
This class is an [Abstract Factory](http://en.wikipedia.org/wiki/Abstract_factory_pattern) for the [Zend\_Acl](http://framework.zend.com/manual/en/zend.acl.html) class.

# API #
| **Method** | **Description** |
|:-----------|:----------------|
| `create()` | Get a [Zend\_Acl](http://framework.zend.com/manual/en/zend.acl.html)  object. |
| `setConfigFile(/* string */ $filename)` | Set the configuration file. This should be a `.php` file that uses `$acl` to setup the roles, resources and rules. |

# Examples #
## Basic ##
Basic usage of the `Rend_Factory_Acl` is to create an instance of the factory and call it's `create()` method on demand.

```
class MyController extends Rend_Controller_Action {
    public function init() {
        $aclFactory = new Rend_Factory_Acl(array(
            "configFile" => "../application/config/acl.php"
        ));
        $this->_acl = $aclFactory->create();
    }
}
```