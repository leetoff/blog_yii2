<?php
//* Права доступа
//* вынести блок access из SiteController в /config/main.php
//* as access
//* except
//*
//*
//* одновременная авторизация
//* session, user, request
//* в /backend, /frontend - similar
//* название куки сессии - одинаоковое
//* session { domain: .mysite.test}
//* user.identityCookie { domain: .mysite.test }
//*
//* домен можно вынести в /config/params.php {cookieDomain => }
//*
//* одинаковый секрет кеу на фронт и бэк в config/main-local.php
//*
//*
//* URL manager*****
//* можно вынести urlManager в отдельный конфиг файл require (__DIR__ . 'urlManager.php')
//    * frontendUrlManager => function() { require }
//* backendUrlManager => function() { require }
//* @alias для frontend|backend UrlManager
return [
    'class'=> 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
    ],
];
