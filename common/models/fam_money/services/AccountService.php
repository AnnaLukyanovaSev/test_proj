<?php

namespace common\models\fam_money\services;

use common\models\fam_money\forms\AccountForm;
use common\models\fam_money\Account;
use common\models\fam_money\repositories\AccountRepository;

class AccountService
{
    private $accounts;

    public function __construct(AccountRepository $accounts)
    {
        $this->accounts = $accounts;
    }

    public function create(AccountForm $form): Account
    {
        $transaction = Account::create($form->amount, $form->currency);
        $this->accounts->save($transaction);
        $this->accounts->save($transaction);
        return $transaction;
    }

    public function edit($id, AccountForm $form): void
    {
        $transaction= $this->accounts->get($id);
        $transaction->edit(
            $form->amount,
            $form->currency
        );
        $this->accounts->save($transaction);
    }

    public function remove($id): void
    {
        $transaction = $this->accounts->get($id);

        $this->accounts->remove($transaction);
    }

}