<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    /**
     * The directory that holds the SQLite databases.
     * Utilise le dossier writable/database/ de CI4
     */
    public string $filesPath = WRITEPATH . 'database' . DIRECTORY_SEPARATOR;

    /**
     * Connexion par défaut → SQLite3
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => '',
        'password'     => '',
        'database'     => WRITEPATH . 'database/supermarche.db',  // chemin vers le fichier .db
        'DBDriver'     => 'SQLite3',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8',
        'DBCollat'     => '',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];

    /**
     * Connexion pour les tests (optionnel)
     * Utilise une base séparée pour ne pas polluer la vraie base
     */
    public array $tests = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => '',
        'password' => '',
        'database' => WRITEPATH . 'database/supermarche_test.db',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'test_',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => '',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    public function __construct()
    {
        parent::__construct();

        // Si on est en mode test, utiliser la base de test
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}