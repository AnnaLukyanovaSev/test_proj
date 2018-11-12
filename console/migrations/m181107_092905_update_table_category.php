<?php

use yii\db\Migration;

/**
 * Class m181107_092905_update_table_category
 */
class m181107_092905_update_table_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'lft', $this->integer()->notNull());
        $this->addColumn('category', 'rgt', $this->integer()->notNull());
        $this->addColumn('category', 'depth', $this->integer()->notNull());
        $this->dropColumn('category', 'parent_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181107_092905_update_table_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181107_092905_update_table_category cannot be reverted.\n";

        return false;
    }
    */
}
