<?php

session_start();

$root = getcwd();
$root = str_replace('/public', '', $root);
define('ROOT', $root);


define('USE_MEMCACHED', false);
/* start a memcached service that uses a cache space of 512 MB
and listens on the TCP and UDP port 11211:
        memcached -d -m 512 -l 127.0.0.1 -p 11211 -u dpraes */
global $memcacheD;
$memcacheD = new Memcached;
$memcacheD->addServer('localhost', 11211, 80);

/*
* Define the auto-load function for classes
*/
// function __autoload($class)
function classAutoLoad($class)
{
    $filename = ROOT . "/sys/class/".$class.".php";
    if (file_exists($filename)) {
        include_once $filename;
    }
}

// Register autoload functions avoiding conflicts
spl_autoload_register('classAutoLoad');
