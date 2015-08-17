<?php
/**
 * UrlHistory
 *
 * @package urlhistory
 */
/**
 * @package urlhistory
 * @subpackage build
 */
$plugins = array();

/* create the plugin object */
$plugins[0] = $modx->newObject('modPlugin');
$plugins[0]->set('id',1);
$plugins[0]->set('name','UrlHistory');
$plugins[0]->set('description','Detects and saves uri changes on document save or drag&drop.');
$plugins[0]->set('plugincode', getSnippetContent($sources['plugins'] . 'urlhistory.plugin.php'));
$plugins[0]->set('category', 0);

$events = array();

$events['OnBeforeDocFormSave']= $modx->newObject('modPluginEvent');
$events['OnBeforeDocFormSave']->fromArray(array(
      'event' => 'OnBeforeDocFormSave',
      'priority' => 0,
      'propertyset' => 0,
 ),'',true,true);
$events['OnDocFormSave']= $modx->newObject('modPluginEvent');
$events['OnDocFormSave']->fromArray(array(
    'event' => 'OnDocFormSave',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);
$events['OnResourceSort']= $modx->newObject('modPluginEvent');
$events['OnResourceSort']->fromArray(array(
    'event' => 'OnResourceSort',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);

if (is_array($events) && !empty($events)) {
    $plugins[0]->addMany($events);
    $modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($events).' Plugin Events for UrlHistory.'); flush();
} else {
    $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find plugin events for UrlHistory!');
}
unset($events);

/* create the plugin object */
$plugins[1] = $modx->newObject('modPlugin');
$plugins[1]->set('id',2);
$plugins[1]->set('name','UrlHistory404');
$plugins[1]->set('description','Handles 404 and redirects form old urls.');
$plugins[1]->set('plugincode', getSnippetContent($sources['plugins'] . 'urlhistory404.plugin.php'));
$plugins[1]->set('category', 0);

$events = array();

$events['OnPageNotFound']= $modx->newObject('modPluginEvent');
$events['OnPageNotFound']->fromArray(array(
    'event' => 'OnPageNotFound',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);

if (is_array($events) && !empty($events)) {
    $plugins[1]->addMany($events);
    $modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($events).' Plugin Events for UrlHistory404.'); flush();
} else {
    $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find plugin events for UrlHistory404!');
}
unset($events);

return $plugins;