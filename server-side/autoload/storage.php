<?php

interface storage {
  public function start();
  public function save_pos($lat, $lon, $device_id);
  public function stop();
  public function get_options();
  public function set_options(array $opts);
}
