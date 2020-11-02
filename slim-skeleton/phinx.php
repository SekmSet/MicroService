<?php

use App\Migration\Migration;

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/src/Migration',
        'seeds' => '%%PHINX_CONFIG_DIR%%/src/Seeds'
    ],
    'migration_base_class' => Migration::class,
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'micro_service',
            'user' => 'root',
            'pass' => 'Obrigada',
            'port' => '3306',
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];
