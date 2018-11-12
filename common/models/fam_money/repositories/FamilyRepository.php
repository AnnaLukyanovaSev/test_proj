<?php

namespace common\models\fam_money\repositories;

use common\models\fam_money\Family;
use yii\web\NotFoundHttpException;

class FamilyRepository
{

    public function get(int $id): Family
    {
        if (!$family = Family::findOne($id)) {
            throw new NotFoundException('Profile not found!');
        }
        return $family;
    }

    public function save(Family $family): void
    {
        if (!$family->save()) {
            throw new \RuntimeException('Saving error!');
        }
    }

    public function remove(Family $family): void
    {
        if (!$family->delete()) {
            throw new \RuntimeException('Removing error!');
        }
    }
}