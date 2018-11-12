<?php

namespace common\models\fam_money\repositories;

use common\models\fam_money\Account;

class AccountRepository
{

    public function get(int $id): Account
    {
        if (!$account =Account::findOne($id)) {
            throw new NotFoundException('Profile not found!');
        }
        return $account;
    }

    public function save(Account $account): void
    {
        if (!$account->save()) {
            throw new \RuntimeException('Saving error!');
        }
    }

    public function remove(Account $account): void
    {
        if (!$account->delete()) {
            throw new \RuntimeException('Removing error!');
        }
    }
}