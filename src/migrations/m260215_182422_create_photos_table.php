<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photos}}`.
 */
class m260215_182422_create_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photos}}', [
            'id' => $this->primaryKey(),
            'album_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
//            'url' => $this->string(255)->notNull(),
        ]);
        $this->addForeignKey(
            'fk-photos-album_id',
            'photos',
            'album_id',
            'albums',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-photos-album_id', 'photos');
        $this->dropTable('{{%photos}}');
    }
}
