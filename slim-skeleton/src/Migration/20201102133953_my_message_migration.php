<?php
declare(strict_types=1);

use App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

final class MyMessageMigration extends Migration
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
    public function up() {
        $this->schema->create('messages', function(Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            $table->integer('id_userS');
            $table->integer('id_userR');
            $table->longText('message');
            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
        });
    }
    public function down() {
        $this->schema->drop('messages');
    }
}
