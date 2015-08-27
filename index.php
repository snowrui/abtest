<?php

require_once 'Abtest.php';

$choice = Abtest::get('egg_v2', $conf['egg_v2']);

var_dump($choice);

