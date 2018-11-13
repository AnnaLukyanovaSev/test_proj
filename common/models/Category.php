<?php

namespace common\models;

use yii\db\ActiveRecord;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;
use wokster\treebehavior\NestedSetsTreeBehavior;

/**
 * @property Family $family
 * @property User $user
 * @property Transaction[] $transactions
 */
class Category extends ActiveRecord
{
    public $sub;

    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
            ],
            'htmlTree' => [
                'class' => NestedSetsTreeBehavior::className()
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    parent::EVENT_BEFORE_INSERT => ['created_at']
                ]
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['user_id', 'family_id', 'created_at', 'lft', 'rgt', 'depth'], 'integer'],
            [['name', 'sub',], 'string', 'max' => 255],
            [
                ['family_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Family::className(),
                'targetAttribute' => ['family_id' => 'id']
            ],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
            ],
            [['lft', 'rgt', 'depth'], 'safe'],
            ['user_id', 'default', 'value' => strval(Yii::$app->user->identity->getId())],
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQ
    {
        return new CategoryQ(static::class);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
            'family_id' => 'Family ID',
            'created_at' => 'Created At',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamily()
    {
        return $this->hasOne(Family::className(), ['id' => 'family_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['category_id' => 'id']);
    }

    public static function tree(): array
    {
        $all = self::find()->select(['id', 'name', 'lft', 'rgt', 'depth'])->asArray()->all();
        $maxDepth = self::find()->max('depth');
        foreach ($all as $row) {
            if ($row['depth'] == 0) {
                ;
            };
        }
        $tree = [

        ];
        return $tree;
    }
}