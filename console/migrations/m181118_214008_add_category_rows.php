<?php

use yii\db\Migration;

/**
 * Class m181118_214008_add_category_rows
 */
class m181118_214008_add_category_rows extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'category', ['id', 'name', 'user_id', 'created_at', 'lft', 'rgt', 'depth'],
            [
                ['8', 'Category', '1', '1542267403', '1', '8', '0'],
                ['9', 'Income', '1', '1542267550', '2', '3', '1'],
                ['10', 'Expense', '1', '1542267653', '4', '5', '1'],
                ['11', 'Transfer', '1', '1542267756', '6', '7', '1']
            ]
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181118_214008_add_category_rows cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181118_214008_add_category_rows cannot be reverted.\n";

        return false;
    }
    */
}
