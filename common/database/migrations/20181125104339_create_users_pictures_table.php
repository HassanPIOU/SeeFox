<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersPicturesTable extends AbstractMigration
{

    public function change()
    {
        $this->table('users')->addColumn('picture', 'string', ['null' => true])
            ->update();
    }
}
