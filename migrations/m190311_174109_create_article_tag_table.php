<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m190311_174109_create_article_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_tag', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'article_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-tag-id',
            'article_tag',
            'user_id'
        );

        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-article-id',
            'article_tag',
            'article_id'
        );

        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_tag');
    }
}
