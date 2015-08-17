<?php
/**
 * Loads the home page.
 *
 * @package urlhistory
 * @subpackage controllers
 */
class UrlHistoryHomeManagerController extends UrlHistoryBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('urlhistory'); }
    public function loadCustomCssJs() {
        $this->addJavascript($this->urlhistory->config['jsUrl'].'mgr/widgets/items.grid.js');
        $this->addJavascript($this->urlhistory->config['jsUrl'].'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->urlhistory->config['jsUrl'].'mgr/sections/home.js');
    }
    public function getTemplateFile() { return $this->urlhistory->config['templatesPath'].'home.tpl'; }
}