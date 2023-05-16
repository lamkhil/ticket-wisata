<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Wisata extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'              => ['type' => 'varchar', 'constraint' => 255],
            'harga'             => ['type' => 'INT'],
            'photo_path'        => ['type' => 'varchar', 'constraint' => 255],
            'alamat'            => ['type' => 'varchar', 'constraint' => 255],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('wisata', true);

        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'slug'              => ['type' => 'varchar', 'constraint' => 255],
            'user_id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'wisata_id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'amount'            => ['type' => 'INT', 'constraint' => 11],
            'status'            => ['type' => 'varchar', 'constraint' => 255, 'default'=>'new'],
            'midtrans_result'   => ['type' => 'LONGTEXT', 'null'=>true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('transaksi', true);

        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'wisata_id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'transaksi_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'kode'              => ['type' => 'varchar', 'constraint' => 255],
            'claimed_at'        => ['type' => 'datetime', 'null' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tiket', true);
    }

    public function down()
    {
        $this->forge->dropTable('wisata', true);
        $this->forge->dropTable('tiket', true);
        $this->forge->dropTable('transaksi', true);
    }
}
