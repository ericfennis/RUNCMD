<?php return array (
  'application' => 
  array (
    'debug' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'mysql' => 
      array (
        'host' => 'localhost',
        'user' => 'root',
        'password' => '123123',
        'dbname' => 'runcmd',
        'prefix' => 'pk_',
      ),
    ),
  ),
  'system' => 
  array (
    'secret' => 'Ss5yJH.abgKFC6dVJoEiNCiYxnsr7Y/i2UBPpnV350OeEdSSI0iJKdL3nG.KuRBO',
  ),
  'system/cache' => 
  array (
    'caches' => 
    array (
      'cache' => 
      array (
        'storage' => 'auto',
      ),
    ),
    'nocache' => true,
  ),
  'system/finder' => 
  array (
    'storage' => '',
  ),
  'debug' => 
  array (
    'enabled' => false,
  ),
);