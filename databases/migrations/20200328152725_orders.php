<?php

use Phinx\Migration\AbstractMigration;

class Orders extends AbstractMigration
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
        $table = $this->table('orders');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('name', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('sale_price', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('sku', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('line_items', 'string', ['limit' => 200])
            ->addColumn('currency', 'string', ['limit' => 5])
            ->addColumn('images', 'string', ['limit' => 100])
            ->addColumn('status', 'enum', ['values' => [
                'pending', 'processing', 'on-hold','completed',
                'cancelled', 'refunded', 'failed', 'trash']
            ])
            ->addColumn('created_at', 'integer')
            ->addColumn('updated_at', 'integer', ['null' => true])
            ->create();
    }
}
