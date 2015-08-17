<?php
/**
 * UrlHistory404 Plugin
 *
 * Events: OnPageNotFound
 *
 * @author Jiri Pavlicek <jiri@pavlicek.cz>
 *
 * @var modX $modx
 *
 * @package urlhistory
 * @subpackage build
 */

global $modx;

$eventName = $modx->event->name;

$urlhistory = $modx->getService('urlhistory','UrlHistory',$modx->getOption('urlhistory.core_path',null,$modx->getOption('core_path').'components/urlhistory/').'model/urlhistory/',$scriptProperties);
if (!($urlhistory instanceof UrlHistory)) return '';

if ($modx->event->name != 'OnPageNotFound') {
    return;
}

$this_uri = $_SERVER['REQUEST_URI'];
if (substr($this_uri, 0, 1) == '/') {
    $this_uri = substr($this_uri, 1);
}

$urlHistoryItem = $modx->getObject('UrlHistoryItem', array('uri' => $this_uri));
if ($urlHistoryItem) {
    $urlHistoryItem->set('count', $urlHistoryItem->get('count') + 1);
    $urlHistoryItem->save();
    $docid = $urlHistoryItem->get('docid');
    if ($docid && ($uri = $modx->makeUrl($docid))) {
        $modx->sendRedirect($uri);
    }
}

return;