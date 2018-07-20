<?php

namespace common\essences;

use common\essences\User;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $author_id
 * @property int $arcticle_id
 * @property int $level
 * @property int $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property int $tree
 * @property string $datetime
 * @property string $text
 *
 * @property Blog $arcticle
 * @property User $author
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['author_id', 'arcticle_id'], 'required'],
            [['author_id', 'arcticle_id', 'level', 'parent_id','lft','rgt','depth','tree'], 'integer'],
            [['datetime','lft','rgt','depth', 'tree'], 'safe'],
            [['text'], 'string'],
            [['arcticle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['arcticle_id' => 'id']],
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
            'arcticle_id' => 'Arcticle ID',
            'level' => 'Level',
            'parent_id' => 'Parent ID',
            'datetime' => 'Datetime',
            'text' => 'Text',
            'lft' => 'Left',
            'rgt' => 'Right',
            'depth' => 'Depth'
        ];
    }
    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'depthAttribute' => 'depth',
            ],
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
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new CommentsQuery(get_called_class());
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

}
