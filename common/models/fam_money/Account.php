<?php

namespace common\models\fam_money;

use yii\db\ActiveRecord;

class Account extends ActiveRecord
{
    /**
     * @var string $currency
     * @var int $amount
     */
    public $currency;
    public $amount;

    public static function create(string $currency, int $amount): self
    {
        $account = new static();
        $account ->currency = $currency;
        $account ->amount = $amount;
        return $account ;
    }

    public function edit(string $currency, int $amount): void
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public static function tableName()
    {
        return 'account';
    }
}