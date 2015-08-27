<?php

require_once 'config.php';
require_once 'Abtest/Storage.php';
require_once 'Abtest/Strategy.php';

/**
 * Abtest
 *
 * @author 潘瑞 <ryan@huoban.com>
 */
class Abtest {

    /**
     * get
     *
     * @param mixed $name
     * @param mixed $abtest_conf
     * @param string $data
     * @static
     * @access public
     * @return void
     */
    public static function get($name, $abtest_conf, $data = '') {

        $choices = $abtest_conf['choices'];
        $strategy_key = key($abtest_conf['strategy']);
        $strategy_conf = current($abtest_conf['strategy']);

        $strategy = Abtest_Strategy::factory($choices, $strategy_key);
        $storage = Abtest_Storage::factory($name);

        if ($storage->get() !== NULL) {
            $choice_index = $storage->get();
            if ($choice = $abtest_conf['choices'][$choice_index]) {
                return $choice;
            }
        }

        $result = $strategy->get_choice($strategy_conf, $data);
        $storage->set($strategy->get_choice_index());

        return $result;
    }
}

/*
$res = array();
for ($i =0; $i < 100; $i ++) {
    $choice = Abtest::get('egg_v2', $conf['egg_v2']);
    if (is_array($choice)) {
        $choice = md5(json_encode($choice));
    }

    $res[$choice] += 1;
}

var_dump($res);

$res = array();
for ($i =0; $i < 10000; $i ++) {
    $choice = Abtest::get('egg_v1', $conf['egg_v1']);
    if (is_array($choice)) {
        $choice = $choice['controller'];
    }

    $res[$choice] += 1;
}

var_dump($res);
 */
