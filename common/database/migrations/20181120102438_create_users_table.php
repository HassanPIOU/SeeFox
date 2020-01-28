<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        $this->table('users')
            ->addColumn('name', 'string')
            ->addColumn('email' , 'string')
            ->addColumn('updated_at', 'datetime')
            ->addColumn('created_at', 'datetime')
            ->create();
    }
}
