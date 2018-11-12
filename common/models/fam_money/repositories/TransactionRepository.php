<?php

namespace common\models\fam_money\repositories;

use common\models\fam_money\Transaction;

class TransactionRepository
{

    public function get(int $id): Transaction
    {
        if (!$transaction =Transaction::findOne($id)) {
            throw new NotFoundException('Profile not found!');
        }
        return $transaction;
    }

    public function save(Transaction $transaction): void
    {
        if (!$transaction->save()) {
            throw new \RuntimeException('Saving error!');
        }
    }

    public function remove(Transaction $transaction): void
    {
        if (!$transaction->delete()) {
            throw new \RuntimeException('Removing error!');
        }
    }
}