<?php

interface storage {
  public function start();
  public function save_pos($lat, $lon, $t, $device_id, $key);
  public function get_last_pos($device_id);
  public function stop();
  public function get_options();
  public function set_options(array $opts);
}
