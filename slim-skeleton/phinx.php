<?php

use App\Migration\Migration;

require __DIR__ . '/vendor/autoload.php';

// autoload .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

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
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB'],
            'user' => $_ENV['DB_USERNAME'],
            'pass' => $_ENV['DB_PWD'],
            'port' => '3306',
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];
