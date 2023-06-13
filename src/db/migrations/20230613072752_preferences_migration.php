<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Util\Literal;

final class PreferencesMigration extends AbstractMigration
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
        // create the table
        $table = $this->table('newsgator_preferences');

        $table->addColumn('created', 'datetime', [
            'timezone' => true,
            'default' => Literal::from('now()')
        ])
            ->addColumn('sources', 'string', ['null' => true])
            ->addColumn('categories', 'string', ['null' => true])
            ->addColumn('authors', 'string', ['null' => true])
            ->addColumn('user_id', 'integer', ['null' => true, 'signed' => false])
            ->addForeignKey('user_id', 'newsgator_users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->save();
    }
}