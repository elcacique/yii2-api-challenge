<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m260215_182303_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id'          => $this->primaryKey(),
            'username'    => $this->string(50),
            'password'    => $this->string(255),
            'authKey'     => $this->string(255),
            'accessToken' => $this->string(255),
            'first_name'  => $this->string(50),
            'last_name'   => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
