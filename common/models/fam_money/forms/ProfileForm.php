<?php

namespace common\models\fam_money\forms;


use common\models\fam_money\Profile;
use common\models\User;
use yii\base\Model;

class ProfileForm extends Model
{
    /**
     * @var string $firstName
     * @var string $lastName
     */
    public $first_name;
    public $last_name;

    private $profile;

    public function __construct(Profile $profile = null, $config = [])
    {
        if ($profile) {
            $this->first_name = $profile->first_name;
            $this->last_name = $profile->last_name;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['user_id'], 'integer','unique'],
            [['first_name', 'last_name'], 'required', 'string', 'max' => 255],
            [
                ['first_name', 'last_name'],
                'match',
                'pattern' => '/[a-z]*/i',
                'message' => 'Only letters are allowed to input'
            ],
            ['user_id','exist','targetClass'=>User::className(),
                'targetAttribute' => ['user_id'=>'id']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last Name',
        ];
    }

}
