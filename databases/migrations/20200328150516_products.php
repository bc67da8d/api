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
            ->addColumn('type', 'string', ['limit' => 100])
            ->addColumn('featured', 'boolean')
            ->addColumn('price', 'string', ['limit' => 100])
            ->addColumn('sale_price', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('sku', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('short_description', 'text', ['null' => true])
            ->addColumn('on_sale', 'boolean')
            ->addColumn('weight', 'string', ['limit' => 100])
            ->addColumn('categories', 'string', ['limit' => 100])
            ->addColumn('tags', 'string', ['limit' => 100])
            ->addColumn('images', 'string', ['limit' => 100])
            ->addColumn('stock_status', 'enum', ['values' => ['instock', 'outofstock', 'onbackorder']])
            ->addColumn('status', 'enum', ['values' => ['0', '1', '2']])
            ->addColumn('created_at', 'integer')
            ->addColumn('updated_at', 'integer', ['null' => true])
            ->create();
    }
}
