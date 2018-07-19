<?php

namespace common\essences;

use common\essences\User;
use common\essences\Comments;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property int $author_id
 * @property string $datetime
 * @property string $title
 * @property string $body
 *
 * @property User $author
 * @property Comments[] $comments
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['author_id'], 'required'],
            [['author_id'], 'integer'],
            [['datetime'], 'safe'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'datetime' => 'Datetime',
            'title' => 'Title',
            'body' => 'Body',
        ];
    }
        public function behaviors()
    {
        return [
            'AuthorBehavior' => [
                'class' => 'common\behaviors\AuthorBehavior',
                'first_attribute' => 'author_id',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['datetime'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['datetime'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
