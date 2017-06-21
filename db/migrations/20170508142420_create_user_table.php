<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addColumn('password_reset_date', 'datetime')
            ->addColumn('email', 'string')
            ->addColumn('name', 'text')
            ->addColumn('status', 'text')
            ->addColumn('created_at', 'datetime')
            ->addcolumn('updated_at', 'datetime')
            ->create();
    }
}
