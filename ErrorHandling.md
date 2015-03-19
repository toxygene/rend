# Enhanced Error Handling #

Rend expands on the [Zend\_Controller\_Plugin\_ErrorHandler](http://framework.zend.com/manual/en/zend.controller.plugins.html#zend.controller.plugins.standard.errorhandler) by forwarding to error specific actions based on error types.

## Controller ##
`EXCEPTION_NO_CONTROLLER` and `EXCEPTION_NO_ACTION` are simply forwarded to the `pageNotFoundAction()`, where a 404 header is sent and the `page-not-found.phtml` script is rendered. `EXCEPTION_NO_CONTROLLER` is automatically thrown by the dispatcher when a controller can't be found. `EXCEPTION_NO_ACTION` is automatically thrown by the controller when an action can't be found. This behavior can be used within your actions by throwing a `Zend_Controller_Action_Exception` with a code of 404.

`Rend_Controller_Action_Exception_Auth` (which is thrown by the Acl helper) forwards to `unauthorizedAction()`, where a 401 header is sent and the `unauthorized.phtml` script is rendered. `Rend_Controller_Action_Exception_Acl` (which is also thrown by the Acl helper) forwards to `forbiddinAction()`, where a 403 header is sent and the `forbiddin.phtml` script is rendered. Each of these exceptions are throw by `Rend_Controller_Action_Helper_IsAllowed`.

The remaining exceptions are assumed to be unhandled exceptions from your applications actions, so these are forwarded to `internalErrorAction()` where a 500 header is sent and the `internal-error.phtml` script is rendered.

## View ##
All the views for the `ErrorController` conditionally display information about the exception based on the `display_errors` setting in the config file. If the display is enabled, the exception message and stack trace will be displayed in an lightbox.

### Example ###
```
class UserController extends Zend_Controller_Action
{
    public function viewAction()
    {
        $users = new Users();

        $user = $users->find($this->_getParam("id"))
                      ->current();

        if (!$user) {
            /** Zend_Controller_Action_Exception */
            require_once 'Zend/Controller/Action/Exception.php';
            throw new Zend_Controller_Action_Exception("No user found with id of '{$this->_getParam('id')}'", 404);
        }

        $this->view->user = $user;
    }
}
```

In this example, the code attempts to fetch a user row from the database. If it does not return a user row, it throws an exception, which will, if not handled, bubble up to the `ErrorController`. `Zend_Controller_Action_Exception` exceptions with a code of `404` are considered to be `404 Page Not Found` errors and are forwarded to the `pageNotFoundAction()`.