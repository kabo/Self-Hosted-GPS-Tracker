<?php

class file_storage extends abstract_storage {
  protected $f;
  protected $opts = array(
    'path'  => '/tmp/gps-position.txt'
  );
  public function start() {
    $this->f = fopen($this->opts['path'],"w");
  }
  public function save_pos($lat, $lon, $device_id) {
    fwrite($this->f, date("Y-m-d H:i:s")."_".$lat."_".$lon."_".$device_id);
  }
  public function stop() {
    fclose($this->f);
  }
  public function get_last_pos($device_id) {
    $date_lat_lon = rtrim(fgets($this->f));
    if (!$date_lat_lon) {
    	throw new Exception("Unable to get latest position");
    }
    return explode("_", $date_lat_lon);
  }
}
