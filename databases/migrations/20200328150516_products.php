<?php

use Phinx\Migration\AbstractMigration;

class Products extends AbstractMigration
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
        $table = $this->table('products');
        $table
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('slug', 'string', ['limit' => 100])
            ->addColumn('type', 'boolean', ['null' => false, 'signed' => false])
            ->addColumn('featured', 'boolean', ['null' => true])
            ->addColumn('price', 'string', ['limit' => 100])
            ->addColumn('sale_price', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('sku', 'string', ['limit' => 100])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('short_description', 'text', ['null' => true])
            ->addColumn('on_sale', 'boolean', ['null' => true])
            ->addColumn('weight', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('categories', 'string', ['limit' => 100])
            ->addColumn('tags', 'string', ['limit' => 100])
            ->addColumn('images', 'string', ['limit' => 100])
            ->addColumn('stock_status', 'boolean', ['null' => false, 'signed' => false])
            ->addColumn('status', 'boolean', ['null' => false, 'signed' => false])
            ->addColumn('created_at', 'integer')
            ->addColumn('updated_at', 'integer', ['null' => true])
            ->create();
    }
}
