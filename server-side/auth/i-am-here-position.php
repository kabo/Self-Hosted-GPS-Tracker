<?php
require_once '../autoloader.php';
$device_id = !empty($_GET['device_id']) ? $_GET['device_id'] : 'default' ;
$storage = new sqlite_storage();
$storage->start();
echo implode('_', $storage->get_last_pos($device_id));
$storage->stop();
