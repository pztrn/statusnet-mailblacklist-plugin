<?php
/**
 * StatusNet, the distributed open-source microblogging tool
 *
 * Plugin to show questions when a user registers
 *
 * PHP version 5
 *
 * LICENCE: This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  Plugin
 * @package   StatusNet
 * @author    Stanislav Nikitin <pztrn@pztrn.name>
 * @copyright 2013
 * @license   http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License version 3.0
 * @link      http://status.net/
 */

if (!defined('STATUSNET') && !defined('LACONICA')) {
    exit(1);
}

class MailBlacklistPlugin extends Plugin
{

    function onStartRegistrationTry($action)
    {
        $mail = $_POST['email'];
        $mail = explode("@", $mail)[1];
        
        if (in_array($mail, $this->domains))
        {
            $action->showForm(_m('This mail domain not allowed!'));
            return false;
        }
        return true;
    }

    function onPluginVersion(&$versions)
    {
        $versions[] = array('name' => 'MailBlacklist',
                            'version' => '0.1',
                            'author' => 'Stanislav Nikitin',
                            'homepage' => 'http://wiki.loadaverage.org/statusnet/plugins/mailblacklist',
                            'rawdescription' => 'Blacklisting mail domains, for preventing spammers registration.',
                            );
        return true;
    }
}
