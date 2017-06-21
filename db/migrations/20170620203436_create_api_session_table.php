<?php

use Phinx\Migration\AbstractMigration;

class CreateApiSessionTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('api_session');
        $table->addColumn('key_id', 'integer')
            ->addColumn('session_id', 'string')
            ->addColumn('expiration', 'datetime')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addcolumn('updated_at', 'datetime')
            ->create();
    }
}
