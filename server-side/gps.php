<?php

require_once 'autoloader.php';

$storage = new sqlite_storage();

if (isset($_GET["lat"]) && preg_match("/^-?\d+\.\d+$/", $_GET["lat"])
    && isset($_GET["lon"]) && preg_match("/^-?\d+\.\d+$/", $_GET["lon"]) ) {
    $t = null;
    if (isset($_GET["t"]) && preg_match("/^\d+$/", $_GET["t"])) {
        $t = $_GET["t"];
    }
    $device_id = !empty($_GET["device_id"]) ? $_GET["device_id"] : "default" ;
    $storage->start();
    $storage->save_pos($_GET["lat"], $_GET["lon"], $t, $device_id);
	  $storage->stop();
    echo "OK";
} elseif (isset($_GET["tracker"])) {
    // do whatever you want here...
    echo "OK";
} else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Please type this URL in the <a href="https://play.google.com/store/apps/details?id=fr.herverenault.selfhostedgpstracker">Self-Hosted GPS Tracker</a> Android app on your phone.';
}
