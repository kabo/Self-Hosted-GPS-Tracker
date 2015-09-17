<?php

abstract class abstract_storage implements storage {
  protected $opts;
  public function get_options() {
    return $this->opts;
  }
  public function set_options(array $opts) {
    $this->opts = $opts;
  }
}
