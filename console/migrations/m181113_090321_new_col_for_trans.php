<?php

use yii\db\Migration;

/**
 * Class m181113_090321_new_col_for_trans
 */
class m181113_090321_new_col_for_trans extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('transaction', 'date', $this->date()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('transaction','date');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181113_090321_new_col_for_trans cannot be reverted.\n";

        return false;
    }
    */
}
