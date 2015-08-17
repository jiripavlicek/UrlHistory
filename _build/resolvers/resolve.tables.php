<?php
/**
 * UrlHistory
 *
 * Copyright 2015 by Jiri Pavlicek <jiri@pavlicek.cz>
 *
 * UrlHistory is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * UrlHistory is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * UrlHistory; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package urlhistory
 */
/**
 * Resolve creating db tables
 *
 * @package urlhistory
 * @subpackage build
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('urlhistory.core_path',null,$modx->getOption('core_path').'components/urlhistory/').'model/';
            $modx->addPackage('urlhistory',$modelPath);

            $manager = $modx->getManager();

            $manager->createObjectContainer('UrlHistoryItem');

            break;
        case xPDOTransport::ACTION_UPGRADE:
            break;
    }
}
return true;