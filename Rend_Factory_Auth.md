# Description #
This class is an [Abstract Factory](http://en.wikipedia.org/wiki/Abstract_factory_pattern) for the [Zend\_Auth](http://framework.zend.com/manual/en/zend.auth.html) class.

# API #
| **Method** | **Description** |
|:-----------|:----------------|
| `create()` | Get the [Zend\_Auth](http://framework.zend.com/manual/en/zend.auth.html) singleton instance |

# Examples #
## Basic ##
Basic usage of the Rend\_Factory\_Database is to create an instance of the factory and call it's create() method on demand.

```
class MyController extends Rend_Controller_Action {
    public function init() {
        $authFactory = new Rend_Factory_Auth();
        $this->_auth = $authFactory->create();
    }
}
```