<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupermarche extends Migration
{
    public function up()
    {
        // TABLE : utilisateur
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment'  => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'prenom' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'login' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'unique'     => true,
            ],
            'mot_passe' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('utilisateur');

        // TABLE : caisse
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment'  => true,
            ],
            'numero' => [
                'type'   => 'INT',
                'null'   => false,
                'unique' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'actif' => [
                'type'    => 'INT',
                'default' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('caisse');

        // TABLE : produit
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment'  => true,
            ],
            'designation' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'prix' => [
                'type'  => 'DECIMAL',
                'constraint' => '10,2',
                'null'   => false,
            ],
            'quantite' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'code_barre' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('produit');

        // TABLE : achat
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment'  => true,
            ],
            'caisse_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'date_achat' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'statut' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'en_cours',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('caisse_id', 'caisse', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('achat');

        // TABLE : ligne_achat
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment'  => true,
            ],
            'achat_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'produit_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'quantite' => [
                'type'    => 'INT',
                'default' => 1,
            ],
            'prix_unitaire' => [
                'type'  => 'DECIMAL',
                'constraint' => '10,2',
                'null'   => false,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('achat_id', 'achat', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produit_id', 'produit', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ligne_achat');
    }

    public function down()
    {
        $this->forge->dropTable('ligne_achat', true);
        $this->forge->dropTable('achat', true);
        $this->forge->dropTable('produit', true);
        $this->forge->dropTable('caisse', true);
        $this->forge->dropTable('utilisateur', true);
    }
}
