<?php

use common\essences\Comments;
use common\essences\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Comments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'attribute' => 'author_id',
                    'value' => function (Comments $event) {
                        if ($event->author_id==null)
                            return "Anonymous";
                        $author = User::findOne($event->author_id);
                        return $author->username;
                    },
                    'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username')
                ],
                'arcticle_id',
                'level',
                'parent_id',
                'datetime',
                'text:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
</div>
