<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $name
 * @property string $currency
 * @property int $amount
 * @property int $user_id
 * @property int $family_id
 * @property int $created_at
 *
 * @property Family $family
 * @property User $user
 * @property Transaction[] $transactions
 */
class Account extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'account';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    parent::EVENT_BEFORE_INSERT => ['created_at']
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            [['name', 'currency', 'amount'], 'required'],
            ['amount', 'integer'],
            [['name', 'currency'], 'string', 'max' => 255],
            ['user_id','default','value' => strval(Yii::$app->user->identity->getId())],
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
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'currency' => 'Currency',
            'amount' => 'Amount',
            'user_id' => 'User ID',
            'family_id' => 'Family ID',
            'created_at' => 'Created At',
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
        return $this->hasMany(Transaction::className(), ['account_id' => 'id']);
    }
}
