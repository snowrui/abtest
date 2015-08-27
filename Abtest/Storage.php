<?php

class Abtest_Storage {

    public static function factory($abtest_name = 'abtest', $name = 'cookie') {

        switch($name) {
        case 'cooike':
        default:
            return new Abtest_Storage_Cookie($abtest_name);
        }
    }
}

class Abtest_Storage_Cookie {

    public $name;

    public function __construct($name) {
        $this->name = $name . '_abtest';
    }

    public function get() {
        return $_COOKIE[$this->name];
    }

    public function set($choice_index) {
        setcookie($this->name, $choice_index, time() + 3600);
    }

    public function clean() {
        setcookie($this->name, 100, time() - 3600);
    }
}
