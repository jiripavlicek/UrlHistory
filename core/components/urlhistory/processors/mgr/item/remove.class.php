<?php
/**
 * Remove an Item.
 * 
 * @package urlhistory
 * @subpackage processors
 */
class UrlHistoryRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'UrlHistoryItem';
    public $languageTopics = array('urlhistory:default');
    public $objectType = 'urlhistory.items';
}
return 'UrlHistoryRemoveProcessor';