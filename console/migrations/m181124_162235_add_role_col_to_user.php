<?php

use yii\db\Migration;

/**
 * Class m181124_162235_add_role_col_to_user
 */
class m181124_162235_add_role_col_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181124_162235_add_role_col_to_user cannot be reverted.\n";

        return false;
    }
    */
}
