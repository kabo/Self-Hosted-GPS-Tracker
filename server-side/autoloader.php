<?php

define('ROOT', dirname(__FILE__));
function my_autoloader($class) {
  include ROOT.'/autoload/' . $class . '.php';
}

spl_autoload_register('my_autoloader');
