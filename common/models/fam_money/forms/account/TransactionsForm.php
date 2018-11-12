<?php

namespace common\models\fam_money\forms;

use common\models\fam_money\Transaction;
use yii\base\Model;

class TransactionsForm extends Model
{
    /**
     * @var string $currency
     * @var int $amount
     */
    public $currency;
    public $amount;

    public function __construct(Transaction $transaction = null, $config = [])
    {
        if ($transaction) {
            $this->currency = $transaction->currency;
            $this->amount = $transaction->amount;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['id','amount'],'required', 'integer'],
            [['currency'], 'required', 'string', 'max' => 255],

        ];
    }
}