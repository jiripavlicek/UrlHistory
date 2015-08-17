<?php
/**
 * @package urlhistory
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/urlhistoryitem.class.php');
class UrlHistoryItem_mysql extends UrlHistoryItem {}
?>