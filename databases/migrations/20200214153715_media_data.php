<?php

use Phinx\Migration\AbstractMigration;

class MediaData extends AbstractMigration
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
        $table = $this->table('media_data');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('key', 'string', ['limit' => 200])
            ->addColumn('acl', 'string', ['limit' => 50])
            ->addColumn('url', 'string', ['limit' => 200])
            ->addColumn('expires', 'integer', ['null' => true])
            ->addColumn('file_size', 'integer')
            ->addColumn('original_file', 'string', ['limit' => 200])
            ->addColumn('created_at', 'integer')
            ->addColumn('updated_at', 'integer', ['null' => true])
            ->create();
    }
}
