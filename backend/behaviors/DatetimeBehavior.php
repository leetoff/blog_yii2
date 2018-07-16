<?php
namespace backend\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class DatetimeBehavior extends Behavior
{
    public $first_attribute = 'datetime';

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
            $this->owner->{$this->first_attribute} = date('Y-m-d H:i:s');
        else $this->owner->{$this->first_attribute};
    }

}