<?php
$urlhistory = $modx->getService('urlhistory','UrlHistory',$modx->getOption('urlhistory.core_path',null,$modx->getOption('core_path').'components/urlhistory/').'model/urlhistory/',$scriptProperties);
if (!($urlhistory instanceof UrlHistory)) return '';


$m = $modx->getManager();
$m->createObjectContainer('UrlHistoryItem');
return 'Table created.';