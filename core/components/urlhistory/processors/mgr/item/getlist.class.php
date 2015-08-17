<?php
/**
 * Get list Items
 *
 * @package urlhistory
 * @subpackage processors
 */
class UrlHistoryGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'UrlHistoryItem';
    public $languageTopics = array('urlhistory:default');
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'urlhistory.items';

    public function prepareQueryBeforeCount(xPDOQuery $c) {   
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                    'url:LIKE' => '%'.$query.'%',
                ));
        }
        return $c;
    }
}
return 'UrlHistoryGetListProcessor';