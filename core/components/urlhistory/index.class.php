<?php
require_once dirname(__FILE__) . '/model/urlhistory/urlhistory.class.php';

abstract class UrlHistoryBaseManagerController extends modExtraManagerController {
    /** @var UrlHistory $urlhistory */
    public $urlhistory;
    public function initialize() {
        $this->urlhistory = new UrlHistory($this->modx);

        $this->addCss($this->urlhistory->config['cssUrl'].'mgr.css');
        $this->addJavascript($this->urlhistory->config['jsUrl'].'mgr/urlhistory.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            UrlHistory.config = '.$this->modx->toJSON($this->urlhistory->config).';
            UrlHistory.config.connector_url = "'.$this->urlhistory->config['connectorUrl'].'";
        });
        </script>');
        return parent::initialize();
    }
    public function getLanguageTopics() {
        return array('urlhistory:default');
    }
    public function checkPermissions() { return true;}
}

/**
 * @package urlhistory
 */
class IndexManagerController extends UrlHistoryBaseManagerController {
    public static function getDefaultController() { return 'home'; }
}