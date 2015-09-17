<?php

class sqlite_storage extends abstract_storage {
  protected $f;
  protected $opts = array(
    'path'  => 'gps-position.sqlite'
  );
  public function start() {
    $this->f = new SQLite3($this->opts['path']);
    $this->f->exec('CREATE TABLE IF NOT EXISTS positions (
                    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
                    lat NUM NOT NULL,
                    lon NUM NOT NULL,
                    device_id TEXT NOT NULL
                  )');
  }
  public function save_pos($lat, $lon, $device_id) {
    $r = $this->f->exec('INSERT INTO positions (lat, lon, device_id) VALUES (
                         "'.$this->f->escapeString($lat).'",
                         "'.$this->f->escapeString($lon).'",
                         "'.$this->f->escapeString($device_id).'"
                       )');
    var_dump($r);
  }
  public function stop() {
    $this->f->close();
  }
}
