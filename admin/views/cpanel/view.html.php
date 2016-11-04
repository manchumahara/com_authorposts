<?php
/* ------------------------------------------------------------------------
# view.html.php - Component - Author Posts
# ------------------------------------------------------------------------
# author Codeboxr Team
# copyright Copyright (C) 2016 codeboxr.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://codeboxr.com
# Technical Support:- http://codeboxr.com/product/cbx-author-post-arhive-for-joomla/
------------------------------------------------------------------------- */



defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

//Import filesystem libraries. Perhaps not necessary, but does not hurt
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');



/**
 * View class for a list of Cbxevent.
 */
class AuthorpostsViewCpanel extends JViewLegacy
{


	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state      = $this->get('State');
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}


		AuthorpostsHelper::addSubmenu('cpanel');

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since    1.6
	 */
	protected function addToolbar()
	{


		$state = $this->get('State');
		$canDo = AuthorpostsHelper::getActions('com_authorposts');
		$user  = JFactory::getUser();

		JToolBarHelper::title(JText::_('COM_AUTHORPOSTS') . ' :: ' . JText::_('COM_AUTHORPOSTS_CPANEL'));

		if ($user->authorise('core.admin', 'com_authorposts') || $user->authorise('core.options', 'com_authorposts'))
		{
			JToolBarHelper::preferences('com_authorposts');
		}

		$this->extra_sidebar = '';
	}
}
