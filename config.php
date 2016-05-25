<?php return array (
  'application' => 
  array (
    'debug' => false,
  ),
  'database' => 
  array (
    'default' => 'sqlite',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'prefix' => 'pk_',
      ),
    ),
  ),
  'system' => 
  array (
    'secret' => 'SdDzYcg4v4NrMYH.NKLGxYqlz4AeuQJzvmwHPFje0699WM22957VWec5yV1PbON/',
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