<?php
$bootstrap = true;

include "../application/bootstrap.php";

try {
    Zend_Controller_Front::getInstance()
                         ->dispatch();
} catch (Exception $e) {
?>
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
        <pre><?php var_dump($e->getTrace()); ?></pre>
    </body>
</html>
<?php
}
