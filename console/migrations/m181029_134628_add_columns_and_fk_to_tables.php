<?php

use yii\db\Migration;

/**
 * Class m181029_131305_add_columns_to_tables
 */
class m181029_134628_add_columns_and_fk_to_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('transaction', 'family_id', $this->integer());
        $this->addColumn('account', 'family_id', $this->integer());
        $this->addColumn('category', 'family_id', $this->integer());

        $this->addColumn('family', 'created_at', $this->integer());
        $this->addColumn('category', 'created_at', $this->integer());
        $this->addColumn('account', 'created_at', $this->integer());
        $this->addColumn('transaction', 'created_at', $this->integer());

        $this->addForeignKey(
            'fk-family-category-id',
            'category',
            'family_id',
            'family',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-family-transaction-id',
            'transaction',
            'family_id',
            'family',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-family-account-id',
            'account',
            'family_id',
            'family',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-family-category-id', 'category');
        $this->dropForeignKey('fk-family-transaction-id', 'transaction');
        $this->dropForeignKey('fk-family-account-id', 'account');

        // $this->dropColumn('category', 'family_id');
        $this->dropColumn('transaction', 'family_id');
        $this->dropColumn('account', 'family_id');
        $this->dropColumn('category', 'family_id');
        $this->dropColumn('family', 'created_at');
        $this->dropColumn('transaction', 'created_at');
        $this->dropColumn('account', 'created_at');
        $this->dropColumn('category', 'created_at');

        return false;
    }

/*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
    echo "m181029_131305_add_columns_to_tables cannot be reverted.\n";

    return false;
}
*/
}
