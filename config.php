<?php

$conf = array(
    'egg_v1' => array(
        'name' => 'egg_v1',
        'choices' => array(
            array(
                'controller' => 'Jindan_Controller_Index',
                'action' => 'index',
            ),
            array(
                'controller' => 'Jindan_Controller_Index2',
                'action' => 'index2',
            )
        ),
        'strategy' => array(
            'percentage' => array(2, 8)
        ),
    ),
    'egg_v2' => array(
        'name' => 'egg_v2',
        'choices' => array(
            '/tpl/a.tpl',
            '/tpl/b.tpl',
        ),
        'strategy' => array('iprange' => true),
    ),
);
