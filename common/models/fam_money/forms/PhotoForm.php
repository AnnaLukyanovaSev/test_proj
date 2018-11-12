<?php

namespace common\models\fam_money\forms;

use yii\base\Model;

use yii\web\UploadedFile;

class PhotoForm extends Model
{
    public $file;

    public function rules(): array
    {
        return [
            ['file','image'],
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->file = UploadedFile::getInstance($this, 'file');
            return true;
        }
        return false;
    }

}