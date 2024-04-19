<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class InitialMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('customers');
        $table->addColumn('name', 'string', ['limit' => 100])
        ->addColumn('email', 'string', ['limit' => 100])
        ->addColumn('organisation', 'string', ['null' => true, 'limit' => 100])
        ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated', 'datetime', ['null' => true])
        ->addColumn('max_projects', 'integer', ['default' => 5, 'signed' => true])
        ->addIndex(['email'], ['unique' => true])
        ->create();

        $table = $this->table('folders');
        $table->addColumn('id_customer', 'integer')
        ->addColumn('title', 'string', ['limit' => 100])
        ->addColumn('description', 'string', ['limit' => 500])
        ->addTimestamps(null, false) # https://book.cakephp.org/phinx/0/en/migrations.html#valid-column-options
        ->addForeignKey('id_customer', 'customers', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
        ->create();

        $table = $this->table('documents');
        $table->addColumn('id_folder', 'integer')
        ->addColumn('title', 'string', ['limit' => 100])
        ->addColumn('description', 'string', ['limit' => 500])
        ->addColumn('language', 'string', ['limit' => 64])
        ->addTimestamps(null, false) # https://book.cakephp.org/phinx/0/en/migrations.html#valid-column-options
        ->addForeignKey('id_folder', 'folders', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
        ->create();
    }
}
