<?php

class sqlite_storage extends abstract_storage {
  protected $f;
  protected $opts = array(
    'path'  => 'sqlite/gps-position.sqlite'
  );
  public function start() {
    $this->f = new SQLite3($this->opts['path']);
    $this->f->exec('CREATE TABLE IF NOT EXISTS positions (
                    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
                    lat NUM NOT NULL,
                    lon NUM NOT NULL,
                    local_timestamp INT NULL,
                    device_id TEXT NOT NULL
                  )');
  }
  public function save_pos($lat, $lon, $t, $device_id) {
    $t = is_null($t) ? 'NULL' : '"'.$this->f->escapeString($t).'"' ;
    $r = $this->f->exec('INSERT INTO positions (lat, lon, local_timestamp, device_id) VALUES (
                         "'.$this->f->escapeString($lat).'",
                         "'.$this->f->escapeString($lon).'",
                         '.$t.',
                         "'.$this->f->escapeString($device_id).'"
                       )');
  }
  public function stop() {
    $this->f->close();
  }
  public function get_last_pos($device_id) {
    $r = $this->f->query('SELECT timestamp, lat, lon, local_timestamp FROM positions
                          WHERE device_id = "'.$this->f->escapeString($device_id).'"
                          ORDER BY timestamp DESC
                          LIMIT 1');
    return $r->fetchArray(SQLITE3_NUM);
  }
}
