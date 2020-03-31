<?php

use Phinx\Migration\AbstractMigration;

class Posts extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('posts');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('title', 'string', ['limit' => 200])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('image', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('video', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('hash_tag', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('number_view', 'integer', ['null' => true])
            ->addColumn('number_reply', 'integer', ['null' => true])
            ->addColumn('status', 'boolean', ['null' => false, 'signed' => false])
            ->addColumn('created_at', 'integer')
            ->addColumn('updated_at', 'integer', ['null' => true])
            ->create();
    }
}
