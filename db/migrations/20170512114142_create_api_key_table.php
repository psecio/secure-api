<?php

use Phinx\Migration\AbstractMigration;

class CreateApiKeyTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('api_key');
        $table->addColumn('key', 'string')
            ->addColumn('description', 'text')
            ->addColumn('user_id', 'integer')
            ->addColumn('status', 'string', ['default' => 'active'])
            ->addColumn('created_at', 'datetime')
            ->addcolumn('updated_at', 'datetime')
            ->create();
    }
}
