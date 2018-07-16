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
        if (empty($this->owner->{$this->first_attribute} ))
            $this->owner->{$this->first_attribute} = \Yii::$app->user->getId();
        else $this->owner->{$this->first_attribute};
    }

}