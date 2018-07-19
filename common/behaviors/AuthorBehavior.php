<?php

namespace common\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class AuthorBehavior extends Behavior
{
    public $first_attribute = 'user_id';

    public function events()
    {
        return [
//            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeValidate',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate($event)
    {
            if (!Yii::$app->user->isGuest) {
                if (empty($this->owner->{$this->first_attribute}))
                    $this->owner->{$this->first_attribute} = \Yii::$app->user->identity->getId();
                else $this->owner->{$this->first_attribute};
            }
    }

}