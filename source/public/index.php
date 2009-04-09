<?php
$basePath  = realPath("..");
$bootstrap = true;

try {
    include "{$basePath}/application/bootstrap.php";

    Zend_Controller_Front::getInstance()
                         ->dispatch();
} catch (Exception $e) {
    if ($e instanceof Zend_Controller_Dispatcher_Exception || ($e instanceof Zend_Controller_Action_Exception && $e->getCode() == 404)) {
        header ("HTTP/1.0 404 Not Found");
    } else {
        header("HTTP/1.0 500 Internal Server Error");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Unhandled Exception</title>
    </head>
    <body>
        <h1>Unhandled Exception</h1>
        <h2>Message</h2>
        <p><?php echo $e->getMessage(); ?></p>
        <h2>Basic Stack Trace</h2>
        <pre><?php echo $e; ?></pre>
        <h2>Full Stack Trace</h2>
        <?php if (!extension_loaded('xdebug')): ?><pre><?php endif; ?><?php var_dump($e->getTrace()); ?><?php if (!extension_loaded('xdebug')): ?></pre><?php endif; ?>
    </body>
</html>
<?php
}
