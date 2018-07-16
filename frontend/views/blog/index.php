<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use common\essences\Blog;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id',
                [
                    'attribute' => 'author_id',
                    'value' => function (Blog $event) {
                        $author = User::findOne($event->author_id);
                        return $author->username;
                    },
                    'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username')
                ],
                'datetime',
                'title',
                [
                    'attribute'=>'body',
                    'value' => function(Blog $blog){
                        $length=200;
                        $str = substr($blog->body,0,$length);
                        if (strlen($blog->body)>$length)
                            {
                                $str.='...';
                            }
                            return $str;
                    },
                    'contentOptions' => [
                        'style'=>'max-width: 800px; white-space: normal;'
                    ],
                ],

                ['class' => \yii\grid\ActionColumn::className(),
                    'template'=>'{view}',
                ],
            ],
        ]); ?>
</div>
