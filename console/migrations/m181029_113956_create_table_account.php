<?php

use yii\db\Migration;

/**
 * Class m181029_113956_create_table_account
 */
class m181029_113956_create_table_account extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('account', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull(),
            'currency'=> $this->string()->notNull(),
            'amount' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user-account-id',
            'account',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user-account-id', 'account');
        $this->dropTable('account');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181029_113956_create_table_account cannot be reverted.\n";

        return false;
    }
    */
}
