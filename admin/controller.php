<?php
/* ------------------------------------------------------------------------
# controller.php - Component - Author Posts
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
 * Class AuthorpostsController
 *
 * @since  1.6
 */
class AuthorpostsController extends JControllerLegacy
{
	/**
	 * @var		string	The default view.
	 * @since   1.6
	 */
	protected $default_view = 'cpanel';

	/**
	 * Method to display a view.
	 *
	 * @param    boolean $cachable  If true, the view output will be cached
	 * @param    array   $urlparams An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return    JController        This object to support chaining.
	 * @since    1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{

		$view = JFactory::getApplication()->input->getCmd('view', 'cpanel');
		JFactory::getApplication()->input->set('view', $view);

		return parent::display();

	}
}
