<?php

namespace common\models\fam_money\forms\account;

use common\models\fam_money\Transaction;
use common\models\fam_money\Category;
use yii\base\Model;

class CategoriesForm extends Model
{
    public $main;

    public function __construct(Transaction $transaction = null, $config = [])
    {
        if ($transaction) {
            $this->main = $transaction->category_id;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['main','required'],
            ['main','integer'],
        ];
    }
}
