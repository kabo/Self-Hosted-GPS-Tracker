<?php

function my_autoloader($class) {
    include 'autoload/' . $class . '.php';
}

spl_autoload_register('my_autoloader');
