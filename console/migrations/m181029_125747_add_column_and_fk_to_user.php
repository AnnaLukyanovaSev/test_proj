<?php

use yii\db\Migration;

/**
 * Class m181029_125747_add_column_and_fk_to_user
 */
class m181029_125747_add_column_and_fk_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'family_id',$this->integer());
        $this->addForeignKey(
            'fk-family-user-id',
            'user',
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
        $this->dropForeignKey('fk-family-user-id', 'user');
        $this->dropColumn('user', 'family_id');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181029_125747_add_column_and_fk_to_user cannot be reverted.\n";

        return false;
    }
    */
}
