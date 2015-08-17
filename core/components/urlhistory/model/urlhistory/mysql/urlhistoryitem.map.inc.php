<?php
/**
 * @package urlhistory
 */
$xpdo_meta_map['UrlHistoryItem']= array (
  'package' => 'urlhistory',
  'version' => NULL,
  'table' => 'urlhistory_items',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'uri' => NULL,
    'docid' => NULL,
    'responseCode' => 301,
    'count' => 0,
  ),
  'fieldMeta' => 
  array (
    'uri' =>
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => false,
    ),
    'docid' =>
    array (
      'dbtype' => 'int',
      'precision' => '16',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'responseCode' =>
    array (
      'dbtype' => 'int',
      'precision' => '16',
      'phptype' => 'integer',
      'null' => false,
      'default' => 301,
    ),
    'count' =>
    array (
      'dbtype' => 'int',
      'precision' => '16',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
);
