<?php

namespace common\models\fam_money\forms;

use common\models\fam_money\Account;
use yii\base\Model;

class AccountForm extends Model
{
    /**
     * @var string $currency
     * @var int $amount
     */
    public $currency;
    public $amount;

    public function __construct(Account $account = null, $config = [])
    {
        if ($account) {
            $this->currency = $account->currency;
            $this->amount = $account->amount;
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