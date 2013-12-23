<?php
/**
 * @version     1.0.1
 * @package     com_test
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Gala <galina.ck@gmail.com> - http://
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Test helper.
 */
class TestHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_TEST_TITLE_TESTLIST'),
			'index.php?option=com_test&view=testlist',
			$vName == 'testlist'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_TEST_TITLE_TEST_LIST_ADMIN_V1EW_PLURAL_NAME'),
			'index.php?option=com_test&view=test_list_admin_v1ew_plural_name',
			$vName == 'test_list_admin_v1ew_plural_name'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_test';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
