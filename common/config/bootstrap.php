<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@backendurlmanager',__DIR__.'/../../backend/config/backendUrlManager.php');
Yii::setAlias('@frontendurlmanager',__DIR__.'/../../frontend/config/frontendUrlManager.php');
