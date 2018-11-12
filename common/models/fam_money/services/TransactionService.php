<?php

namespace common\models\fam_money\services;

use common\models\fam_money\forms\TransactionForm;
use common\models\fam_money\Transaction;
use common\models\fam_money\repositories\TransactionRepository;

class TransactionService
{
    private $transactions;

    public function __construct(TransactionRepository $transactions)
    {
        $this->transactions = $transactions;
    }

    public function create(TransactionForm $form): Transaction
    {
        $transaction = Transaction::create($form->amount, $form->currency);
        $this->transactions->save($transaction);
        $this->transactions->save($transaction);
        return $transaction;
    }

    public function edit($id, TransactionForm $form): void
    {
        $transaction= $this->transactions->get($id);
        $transaction->edit(
            $form->amount,
            $form->currency
        );
        $this->transactions->save($transaction);
    }

    public function remove($id): void
    {
        $transaction = $this->transactions->get($id);

        $this->transactions->remove($transaction);
    }

}