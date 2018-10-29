<?php

use yii\db\Migration;

/**
 * Class m181029_115435_create_table_transaction
 */
class m181029_115435_create_table_transaction extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaction', [
            'id' => $this->primaryKey(),
            'amount' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'currency'=> $this->string()->notNull(),
            'account_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user-transaction-id',
            'transaction',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-account-transaction-id',
            'transaction',
            'account_id',
            'account',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-category-transaction-id',
            'transaction',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user-transaction-id', 'transaction');
        $this->dropForeignKey('fk-account-transaction-id', 'transaction');
        $this->dropForeignKey('fk-category-transaction-id', 'transaction');
        $this->dropTable('transaction');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181029_115435_create_table_transaction cannot be reverted.\n";

        return false;
    }
    */
}
