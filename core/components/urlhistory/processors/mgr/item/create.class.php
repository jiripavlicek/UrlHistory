<?php
/**
 * Create an Item
 * 
 * @package urlhistory
 * @subpackage processors
 */
class UrlHistoryCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'UrlHistoryItem';
    public $languageTopics = array('urlhistory:default');
    public $objectType = 'urlhistory.items';

    public function beforeSet(){
        $url = $this->getProperty('url');

        if (empty($url)) {
            $this->addFieldError('url',$this->modx->lexicon('urlhistory.item_err_ns_url'));
        } else if ($this->doesAlreadyExist(array('url' => $url))) {
            $this->addFieldError('url',$this->modx->lexicon('urlhistory.item_err_ae'));
        }

        return parent::beforeSet();
    }

    public function afterSave(){
        $urlHistory = new UrlHistory($this->modx);

        $short = $urlHistory->encodeId($this->object->id);

        while($this->modx->getObject('modResource', array('alias' => $short))){
            $newObject = $this->modx->newObject('UrlHistoryItem');
            $newObject->set('url', $this->object->url);
            $newObject->save();
            $short = $urlHistory->encodeId($newObject->id, true);
            $newObject->set('short', $short);
            $newObject->save();
            $this->object->remove();
            $this->object = $newObject;
        }

        $siteUrl = $this->modx->getOption('site_url');

        $this->object->set('short', $siteUrl.$short);
        $this->object->save();

        return parent::afterSave();
    }

}
return 'UrlHistoryCreateProcessor';
