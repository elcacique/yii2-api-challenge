<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%albums}}`.
 */
class m260215_182349_create_albums_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%albums}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
        ]);
        $this->addForeignKey(
            'fk-albums-user_id',
            'albums',
            'user_id',
            'users',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-albums-user_id', 'albums');
        $this->dropTable('{{%albums}}');
    }
}
