# Author Article/Posts for Joomla

Author Articles component for joomla - based on com_content 

Idea: Joomla doesn't have any view for author archive posts or any dedicated view in com_content to show any author's posts. So, I thought to create any generic component that can use the com_content's resource  and can be used for any user's post archive.


Usages

//include the route file from com_authors's site part
require_once JPATH_SITE . '/components/com_authorposts/helpers/route.php';

now 

$author_archive_link = AuthorpostsHelperRoute::getAuthorRoute($author_id, $language = 0);


By default using this component you can create any user's archive posts as menu item.

Thanks


