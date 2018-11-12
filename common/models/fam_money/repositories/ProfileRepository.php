<?php

namespace common\models\fam_money\repositories;

use common\models\fam_money\Profile;
use yii\web\NotFoundHttpException;

class ProfileRepository
{

    public function get(int $id): Profile
    {
        if (!$profile = Profile::findOne($id)) {
            throw new NotFoundException('Profile not found!');
        }
        return $profile;
    }

    public function save(Profile $profile): void
    {
        if (!$profile->save()) {
            throw new \RuntimeException('Saving error!');
        }
    }

    public function remove(Profile $profile): void
    {
        if (!$profile->delete()) {
            throw new \RuntimeException('Removing error!');
        }
    }
}