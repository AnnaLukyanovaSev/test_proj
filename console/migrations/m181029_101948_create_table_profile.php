<?php

use yii\db\Migration;

/**
 * Class m181029_101948_create_table_profile
 */
class m181029_101948_create_table_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profile', [
            'first_name'=> $this->string()->notNull(),
            'last_name'=> $this->string()->notNull(),
            'user_id' => $this->integer()->notNull()->unique(),
        ]);

        $this->addForeignKey(
            'fk-user-profile-id',
            'profile',
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
        $this->dropForeignKey('fk-user-profile-id', 'profile');
        $this->dropTable('profile');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181029_101948_create_table_profile cannot be reverted.\n";

        return false;
    }
    */
}
