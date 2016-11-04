<?php
/* ------------------------------------------------------------------------
# authorposts.php - Component - Author Posts
# ------------------------------------------------------------------------
# author Codeboxr Team
# copyright Copyright (C) 2016 codeboxr.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://codeboxr.com
# Technical Support:- http://codeboxr.com/product/cbx-author-post-arhive-for-joomla/
------------------------------------------------------------------------- */


// No direct access
defined('_JEXEC') or die;

/**
 * Authorposts helper.
 *
 * @since  1.6
 */
class AuthorpostsHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  string
	 *
	 * @return void
	 */
	public static function addSubmenu($vName = '')
	{
		$menus = array();

		$menus[] = array(
			JText::_('COM_AUTHORPOSTS_CPANEL'),
			'index.php?option=com_authorposts&view=cpanel',
			'cpanel'

		);

		//add the menus
		foreach($menus as $menu){
			JHtmlSidebar::addEntry(
				$menu[0], $menu[1], $vName == $menu[2]
			);
		}
		
	}

	/**
	 * Gets the files attached to an item
	 *
	 * @param   int     $pk     The item's id
	 *
	 * @param   string  $table  The table's name
	 *
	 * @param   string  $field  The field's name
	 *
	 * @return  array  The files
	 */
	public static function getFiles($pk, $table, $field)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->select($field)
			->from($table)
			->where('id = ' . (int) $pk);

		$db->setQuery($query);

		return explode(',', $db->loadResult());
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return    JObject
	 *
	 * @since    1.6
	 */
	public static function getActions()
	{
		$user   = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_authorposts';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}