<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property string $first_name
 * @property string $last_name
 * @property int $user_id
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{

    //$user_id = Yii::$app->user->identity->getId();

    public static function tableName()
    {
        return 'profile';
    }

    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
           [['user_id'], 'unique'],
            ['user_id','default','value' => strval(Yii::$app->user->identity->getId())],
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
