<?php
return [
    'class'=> 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'page-<page:\d+>' => 'site/index', //пагинация для главной страницы
        '/' => 'site/index', //главная страница
        '/home' => 'site/index', //главная страница
        '/blog' => 'blog/index',
        //вывод статичных страниц
        [
            'pattern'=>'<action:about>',
            'route' => 'about/<action>',
            'suffix' => '.html',
        ],
        //вывод статичных страниц
        [
            'pattern'=>'<action:contact>',
            'route' => 'contact/<action>',
            'suffix' => '.html',
        ],

        '/about' => '/about/about',
        '/contact' => '/contact/contact',

        //login|logout|signup и тд.
        '<action:\w+>' => 'auth/<action>',

//        //вывод отдельной страницы
//        [
//            'pattern'=>'<url:\w+>',
//            'route' => 'profile/view/<id:\d+>/',
//            'suffix' => '.html',
//        ],
        'blog/<id:\d+>' => 'blog/view',
    ],
];