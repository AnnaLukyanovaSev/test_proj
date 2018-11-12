<?php

namespace common\models\forms;

use Yii;
use yii\base\Model;
use common\models\Profile;

class ProfileForm extends Model
{
    public $firstName;
    public $lastName;

    private $user;

    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [
                ['first_name', 'last_name'],
                'match',
                'pattern' => '/[a-z]*/i',
                'message' => 'Only letters are allowed to input'
            ],
        ];
    }

    public function info()
    {
        /*   if (!$this->validate()) {
               return false;
           } */

        $user = new Profile();
        $user->user_id = Yii::$app->user->identity->getId();
        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;

        if (!$user->save()) {
            throw new \RuntimeException('Saving error!');
        }
        return $user->save();
    }
}