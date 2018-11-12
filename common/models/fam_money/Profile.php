<?php

namespace common\models\fam_money;

use yii\db\ActiveRecord;

//use yii\behaviors\TimestampBehavior;

class Profile extends ActiveRecord
{
    /**
     * @var string $firstName
     * @var string $lastName
     */
    public $first_name;
    public $last_name;
    public $user_id;

    public static function create(string $first_name, string $last_name): self
    {
        $profile = new static();
        $profile->first_name = $first_name;
        $profile->last_name = $last_name;
        return $profile;
    }

    public function edit(string $first_name, string $last_name): void
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public static function tableName()
    {
        return 'profile';
    }

    public function behaviors()
    {
        return [
     /*       [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    parent::EVENT_BEFORE_INSERT => ['create_at', 'reduct_at'],
                    parent::EVENT_BEFORE_UPDATE => ['reduct_at'],
                ],*/
            ];
    }

  /*  public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'crid']);
    } */

}
