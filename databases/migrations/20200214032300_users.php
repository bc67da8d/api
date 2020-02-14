<?php

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
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
        // create the table
        $table = $this->table('users');
        $table
            ->addColumn('role_id', 'integer', ['limit' => 5])
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('password', 'string', ['limit' => 100])
            ->addColumn('register_hash', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('password_forgot_hash', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('gender', 'enum', ['values' => ['male', 'female', 'unknown']])
            ->addColumn('birthday', 'integer', ['limit' => 11, 'null' => true])
            ->addColumn('avatar', 'integer', ['limit' => 11, 'null' => true])
            ->addColumn('status', 'enum', ['values' => ['active', 'inactive', 'deleted']])
            ->addColumn('created_at', 'integer')
            ->addColumn('updated_at', 'integer', ['null' => true])
            ->create();
    }
}
