<?php

use yii\db\Migration;

/**
 * Class m181029_125318_create_table_family
 */
class m181029_125318_create_table_family extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('family', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user-family-id',
            'family',
            'owner_id',
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
        $this->dropForeignKey('fk-user-family-id', 'family');
        $this->dropTable('family');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181029_125318_create_table_family cannot be reverted.\n";

        return false;
    }
    */
}
