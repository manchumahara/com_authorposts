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

defined('_JEXEC') or die;


//load com_content globally for this component as we are actually extending com_content
$language     = JFactory::getLanguage();
$extension    = 'com_content';
$base_dir     = JPATH_SITE;
$language_tag = $language->getTag(); // loads the current language-tag
$language->load($extension, $base_dir, $language_tag, true);

require_once JPATH_COMPONENT . '/helpers/route.php';

//include helper files from com_content
require_once JPATH_SITE . '/components/com_content/helpers/query.php';
require_once JPATH_SITE . '/components/com_content/helpers/route.php';
require_once JPATH_SITE . '/components/com_content/helpers/icon.php';

// Include dependancies
jimport('joomla.application.component.controller');

$input = JFactory::getApplication()->input;
$author_id = $input->getInt('id');

if($author_id <= 0){
    JFactory::getApplication()->enqueueMessage(JText::_('COM_AUTHORPOSTS_ERROR_AUTHOR_NOT_FOUND'), 'warning');
    return;
}


// Execute the task.
$controller = JControllerLegacy::getInstance('Authorposts');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
