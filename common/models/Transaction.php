<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $amount
 * @property int $user_id
 * @property string $currency
 * @property int $account_id
 * @property int $category_id
 * @property int $family_id
 * @property int $created_at
 * @property string $date
 *
 * @property Account $account
 * @property Category $category
 * @property Family $family
 * @property User $user
 */
class Transaction extends \yii\db\ActiveRecord
{
    public $receiver;

    public static function create(int $amount, string $currency, int $account_id, int $category_id, $date): self
    {
        $object = new static();
        $object->amount = $amount;
        $object->currency = $currency;
        $object->account_id = $account_id;
        $object->category_id = $category_id;
        $object->date = $date;
        $object->user_id=Yii::$app->user->identity->getId();
        return $object;
    }

    public function edit(int $amount): void
    {
        $this->amount = $amount;
    }

    public static function tableName()
    {
        return 'transaction';
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'currency', 'account_id', 'category_id', 'date'], 'required'],
            [['amount', 'user_id', 'account_id', 'category_id', 'family_id', 'created_at','receiver'], 'integer'],
            ['user_id', 'default', 'value' => strval(Yii::$app->user->identity->getId())],
            [['date'], 'safe'],
            [['currency'], 'string', 'max' => 255],

            [
                ['account_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Account::className(),
                'targetAttribute' => ['account_id' => 'id']
            ],
            [
                ['category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::className(),
                'targetAttribute' => ['category_id' => 'id']
            ],
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'user_id' => 'User ID',
            'currency' => 'Currency',
            'account_id' => 'Account ID',
            'category_id' => 'Category ID',
            'family_id' => 'Family ID',
            'created_at' => 'Created At',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
}
