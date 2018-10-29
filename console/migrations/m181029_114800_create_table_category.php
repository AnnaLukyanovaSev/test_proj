<?php

use yii\db\Migration;

/**
 * Class m181029_114800_create_table_category
 */
class m181029_114800_create_table_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull(),
            'parent_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user-category-id',
            'category',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-category-category-id',
            'category',
            'parent_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user-category-id', 'category');
        $this->dropForeignKey('fk-category-category-id', 'category');
        $this->dropTable('category');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181029_114800_create_table_category cannot be reverted.\n";

        return false;
    }
    */
}
