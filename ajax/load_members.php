<?php

/**
* ownCloud - bookmarks plugin
*
* @authors Dr.J.Akilandeswari, R.Ramki, R.Sasidharan, P.Suresh
* 
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
* License as published by the Free Software Foundation; either 
* version 3 of the License, or any later version.
* 
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU AFFERO GENERAL PUBLIC LICENSE for more details.
*  
* You should have received a copy of the GNU Lesser General Public 
* License along with this library.  If not, see <http://www.gnu.org/licenses/>.
* 
*/

OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

OCP\JSON::checkAppEnabled('collaboration');

if(isset($_POST['pid']))
{
	if(!OC_Collaboration_Project::isMemberWorkingOnProject(OC_User::getUser(), $_POST['pid']))
	{	
		\OCP\Util::writeLog('collaboration', OC_User::getUser() . ' is trying to access project with Project ID ' . $_POST['pid'], \OCP\Util::WARN);
		OC_JSON::error();
		exit();
	}
	
	OCP\JSON::success(array('members' => OC_Collaboration_Project::getMembers($_POST['pid'])));
	exit();
}
OC_JSON::error();
exit();
