<?php

class Abtest_Strategy {

    public static function factory($choices, $strategy = 'iprange')  {

        switch ($strategy) {
        case 'percentage':
            return new Abtest_Strategy_Percentage($choices);
            break;
        case 'iprange':
        default:
            return new Abtest_Strategy_Iprange($choices);
            break;
        }
    }
}

class Abtest_Strategy_Abstract {

    public $choices = array();
    public $choice_num = 2;
    public $choice_index = 0;

    public function __construct($choices) {

        $this->choices = $choices;
        $choice_num = count($choices);
    }

    public function get_choice() {
        $n = intval(mt_rand() / mt_getrandmax() * 10);

        $index = $n % $this->choice_num;
        $this->choice_index = $index;

        return $this->choices[$index];
    }

    public function get_choice_index() {
        return $this->choice_index;
    }
}

class Abtest_Strategy_Iprange extends Abtest_Strategy_Abstract {

    public function get_choice($ip, $data = '') {

        return parent::get_choice($ip, $data);
    }
}

class Abtest_Strategy_Percentage extends Abtest_Strategy_Abstract {

    public function get_choice($percentage, $data = '') {

        $n = intval(mt_rand() / mt_getrandmax() * 10);

        // 由于随机数据只能产生1~9. 所以列表中先将0索引废弃
        $index_list = array($this->choices[0]);
        $index = 0;
        foreach ($percentage as $value) {
            for ($i = 1; $i <= $value; $i ++) {
                $list[] = $this->choices[$index];
            }
            $index ++;
            if ($index >= $this->choice_num) {
                $index = $this->choice_num - 1 ;
            }
        }

        $this->choice_index = array_search($list[$n], $this->choices);

        return $list[$n];
    }
}
