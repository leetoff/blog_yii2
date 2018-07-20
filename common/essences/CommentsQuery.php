<?php
namespace common\essences;


use creocoder\nestedsets\NestedSetsQueryBehavior;

class CommentsQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}