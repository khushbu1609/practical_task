<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuthFields extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'first_name'     => ['type' => 'VARCHAR', 'constraint' => '100'],
            'last_name'      => ['type' => 'VARCHAR', 'constraint' => '100'],
            'email'          => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'password'       => ['type' => 'VARCHAR', 'constraint' => '255'],
            'dob'  => ['type' => 'DATE', 'null' => true],
            'gender'         => ['type' => 'ENUM', 'constraint' => ['male', 'female', 'other'], 'null' => true],
            'profile_picture'=> ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'address'        => ['type' => 'TEXT', 'null' => true],
            'signature_path' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
