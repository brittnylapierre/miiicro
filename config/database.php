<?php return array (
  'fetch' => 8,
  'default' => 'sqlite',
  'connections' => 
  array (
    'sqlite' => 
    array (
      'driver' => 'sqlite',
      'database' => storage_path().DIRECTORY_SEPARATOR.'104_248_10.sqlite',
      'prefix' => 'site_',
      'host' => '127.0.0.1',
      'username' => 'microweber',
      'password' => 'o+fvUam3l5vSLE4q',
    ),
    'mysql' => 
    array (
      'driver' => 'mysql',
      'host' => 'localhost',
      'database' => 'forge',
      'username' => 'forge',
      'password' => '',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'strict' => false,
    ),
    'pgsql' => 
    array (
      'driver' => 'pgsql',
      'host' => 'localhost',
      'database' => 'forge',
      'username' => 'forge',
      'password' => '',
      'charset' => 'utf8',
      'prefix' => '',
      'schema' => 'public',
    ),
    'sqlsrv' => 
    array (
      'driver' => 'sqlsrv',
      'host' => 'localhost',
      'database' => 'database',
      'username' => 'root',
      'password' => '',
      'prefix' => '',
    ),
  ),
  'migrations' => 'migrations',
  'redis' => 
  array (
    'cluster' => false,
    'default' => 
    array (
      'host' => '127.0.0.1',
      'port' => 6379,
      'database' => 0,
    ),
  ),
);