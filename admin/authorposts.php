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

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_authorposts'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('AuthorpostsHelper', __DIR__ . '/helpers/authorposts.php');

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Authorposts', JPATH_COMPONENT_ADMINISTRATOR);

$controller = JControllerLegacy::getInstance('Authorposts');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
