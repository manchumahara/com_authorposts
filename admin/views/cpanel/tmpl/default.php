<?php
/* ------------------------------------------------------------------------
# default.php - Component - Author Posts
# ------------------------------------------------------------------------
# author Codeboxr Team
# copyright Copyright (C) 2016 codeboxr.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://codeboxr.com
# Technical Support:- http://codeboxr.com/product/cbx-author-post-arhive-for-joomla/
------------------------------------------------------------------------- */

defined('_JEXEC') or die('Restricted access');


JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

//loading js and css frameworks

JHtml::_('behavior.framework'); //loading mootools
JHtml::_('jquery.framework'); //loading jquery


// Import CSS
$document = JFactory::getDocument();
//$document->addStyleSheet('components/com_cbxevent/assets/css/cbxevent.css'); //added globally
$document->addStyleSheet('components/com_authorposts/assets/css/com_authorposts.css'); //only for this view

$user   = JFactory::getUser();
$userId = $user->get('id');


//Joomla Component Creator code to allow adding non select list filters
if (!empty($this->extra_sidebar))
{
	$this->sidebar .= $this->extra_sidebar;
}
?>

<form name="adminForm" id="adminForm">
	<?php if (!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
		<div id="j-main-container">
			<?php endif; ?>
			<div class="row-fluid">
				<div class="span12">
                    <p><a target="_blank" href="http://codeboxr.com/product/cbx-author-post-arhive-for-joomla/"><?php echo JText::_('COM_AUTHORPOSTS_CONTACTUS_SUPPORT'); ?></a></p>
				</div>
			</div>
		</div>
</form>        

		
