<?php

use yii\db\Migration;

/**
 * Class m181029_125140_drop_key_category
 */
class m181029_125140_drop_key_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-category-category-id', 'category');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181029_125140_drop_key_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181029_125140_drop_key_category cannot be reverted.\n";

        return false;
    }
    */
}
