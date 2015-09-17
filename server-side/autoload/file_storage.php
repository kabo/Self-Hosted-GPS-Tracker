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
}
