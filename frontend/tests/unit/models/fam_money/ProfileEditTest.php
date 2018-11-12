<?php

namespace frontend\tests\unit\models\fam_money;

use Yii;
use \Codeception\Test\Unit;

class ProfileEditTest extends Unit
{
    public function testSuccess()
    {
        $profile = Profile::create(
            $firstName = 'first',
            $lastName = 'last'
        );
        $profile->edit($firstName = 'last', $lastName = 'first');
        $this->assertEquals($firstName, $profile->firstName);
        $this->assertEquals($firstName, $profile->lastName);
    }


}