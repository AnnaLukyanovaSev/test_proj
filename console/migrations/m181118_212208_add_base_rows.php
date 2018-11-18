<?php

use yii\db\Migration;

/**
 * Class m181118_212208_add_base_rows
 */
class m181118_212208_add_base_rows extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'id' => '1',
            'username' => 'admin',
            'auth_key' => 'Vx1fs09zWQULH6AnZisYtLd6h8ZsEy8B',
            'password_hash' => '$2y$13$ZOhm2v9nA/isLRS.HXA8Ru5fjHiw7UgHVKqrsOmCZTcqvg0xGk9VO',
            'password_reset_token' => null,
            'email' => 'annieromanenko@gmail.com',
            'status' => '10',
            'created_at' => '1541344006',
            'updated_at' => '1541344006'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181118_212208_add_base_rows cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181118_212208_add_base_rows cannot be reverted.\n";

        return false;
    }
    */
}
