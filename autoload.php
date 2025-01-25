<?php
/** 
*@param string $class
*@return void
*/

spl_autoload_register(function ($class) {
    //project-specific namespace prefix
    $prefix = 'App\\';
    //base directory for namespace prefix
    $base_dir = __DIR__ . '/src/';

    //does class use namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // if no, move to other autoloader
        return;
    }
    //get the relative class name
    $relative_class = substr($class, $len); //$len is starting point index

    $file = $base_dir . $relative_class . '.php';
    if(file_exists($file)) {
        require $file;
    }
});
