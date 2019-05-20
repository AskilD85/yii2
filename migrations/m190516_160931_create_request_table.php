<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m190516_160931_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'user'=>$this->string(20)->notNull(),
            'email'=>$this->string(20)->notNull(),
            'reg_date'=>$this->dateTime()->notNull()->defaultValue(new \yii\db\Expression('NOW()')),
            'status'=>$this->string()->defaultValue('Новая'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request}}');
    }
}
