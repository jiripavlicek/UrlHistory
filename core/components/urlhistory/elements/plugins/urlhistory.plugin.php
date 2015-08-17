<?php
/**
 * UrlHistory Plugin
 *
 * Events: OnBeforeDocFormSave, OnDocFormSave, OnResourceSort
 *
 * @author Jiri Pavlicek <jiri@pavlicek.cz>
 *
 * @var modX $modx
 *
 * @package urlhistory
 * @subpackage build
 */

global $modx;
global $test_uri_old;

$eventName = $modx->event->name;

$urlhistory = $modx->getService('urlhistory','UrlHistory',$modx->getOption('urlhistory.core_path',null,$modx->getOption('core_path').'components/urlhistory/').'model/urlhistory/',$scriptProperties);
if (!($urlhistory instanceof UrlHistory)) return '';

if ($eventName == 'OnBeforeDocFormSave') {
    $test_uri_old = $resource->uri;
    return;
}
if ($eventName == 'OnDocFormSave') {
    if (($test_uri_old != '') && ($test_uri_old != $resource->uri)) {
        $urlHistoryItem = $modx->getObject('UrlHistoryItem', array('uri' => $test_uri_old));
        if ($urlHistoryItem) {
            $urlHistoryItem->set('docid', $resource->id);
        } else {
            $urlHistoryItem = $modx->newObject('UrlHistoryItem',array(
                'uri' => $test_uri_old,
                'docid' => $resource->id,
                'responseCode' => 301,
                'counts' => 0
            ));
        }
        $urlHistoryItem->save();
    }
    return;
}
if ($eventName == 'OnResourceSort') {
    foreach ($modx->event->params['nodesAffected'] as $node) {
        $id = $node->get('id');
        $uri_old = $modx->makeUrl($id, 'web', '', -1, array('site_url' => ''));
        if (($node->get('uri') != 'home') && ($node->get('uri') != $uri_old)) {
            $urlHistoryItem = $modx->getObject('UrlHistoryItem', array('uri' => $uri_old));
            if ($urlHistoryItem) {
                $urlHistoryItem->set('docid', $id);
            } else {
                $urlHistoryItem = $modx->newObject('UrlHistoryItem',array(
                    'uri' => $uri_old,
                    'docid' => $id,
                    'responseCode' => 301,
                    'counts' => 0
                ));
            }
            $urlHistoryItem->save();
        }
    }
    return;
}