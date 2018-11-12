<?php

namespace common\models\fam_money\forms;

use common\models\fam_money\Family;
use yii\base\Model;

class FamilyForm extends Model
{

    public function rules(): array
    {
        return [
            [['id','owner_id',],'required', 'integer'],
        ];
    }
}
