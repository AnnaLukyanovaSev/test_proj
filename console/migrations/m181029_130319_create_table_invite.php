<?php

use yii\db\Migration;

/**
 * Class m181029_130319_create_table_invite
 */
class m181029_130319_create_table_invite extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('invite', [
            'family_id' => $this->integer()->notNull(),
            'secret_str'=> $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-family-invite-id',
            'invite',
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
        $this->dropForeignKey('fk-family-invite-id', 'invite');
        $this->dropTable('invite');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181029_130319_create_table_invite cannot be reverted.\n";

        return false;
    }
    */
}
