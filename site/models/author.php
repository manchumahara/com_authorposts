<?php
/* ------------------------------------------------------------------------
# author.php - Component - Author Posts
# ------------------------------------------------------------------------
# author Codeboxr Team
# copyright Copyright (C) 2016 codeboxr.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://codeboxr.com
# Technical Support:- http://codeboxr.com/product/cbx-author-post-arhive-for-joomla/
------------------------------------------------------------------------- */


defined('_JEXEC') or die;

use Joomla\Registry\Registry;

// Base this model on the backend version.
require_once JPATH_SITE. '/components/com_content/models/articles.php';

//jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Authorposts records.
 *
 * @since  1.6
 */
class AuthorpostsModelAuthor extends ContentModelArticles
{
    /**
     * Model context string.
     *
     * @var		string
     */
    public $_context = 'com_authorposts.author';


    /**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see        JController
	 * @since      1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Elements order
	 * @param   string  $direction  Order direction
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since    1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{

        $app = JFactory::getApplication('site');


		

		// List state information.
		parent::populateState($ordering, $direction);

        // Load state from the request.
        $pk = $app->input->getInt('id');
        $this->setState('filter.author_id', $pk);




        $input = JFactory::getApplication()->input;
        $user  = JFactory::getUser();

        // List state information
        $limitstart = $input->getUInt('limitstart', 0);
        $this->setState('list.start', $limitstart);

        $params = $this->state->params;
        $limit = $params->get('num_leading_articles') + $params->get('num_intro_articles') + $params->get('num_links');
        $this->setState('list.limit', $limit);
        $this->setState('list.links', $params->get('num_links'));



        if ((!$user->authorise('core.edit.state', 'com_content')) &&  (!$user->authorise('core.edit', 'com_content')))
        {
            // Filter on published for those who do not have edit or edit.state rights.
            $this->setState('filter.published', 1);
        }
        else
        {
            $this->setState('filter.published', array(0, 1, 2));
        }

        // Check for category selection
        if ($params->get('authorposts_categories') && implode(',', $params->get('authorposts_categories')) == true)
        {
            $authorpostsCategories = $params->get('authorposts_categories');
            $this->setState('filter.authorposts.categories', $authorpostsCategories);
        }

	}


    /**
     * Method to get a list of articles.
     *
     * @return  mixed  An array of objects on success, false on failure.
     */
    public function getItems()
    {
        $params = clone $this->getState('params');
        $limit = $params->get('num_leading_articles') + $params->get('num_intro_articles') + $params->get('num_links');

        if ($limit > 0)
        {
            $this->setState('list.limit', $limit);

            return parent::getItems();
        }

        return array();
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param   string  $id  A prefix for the store id.
     *
     * @return  string  A store id.
     */
    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id .= $this->getState('filter.author_id');

        return parent::getStoreId($id);
    }

    /**
     * Get the list of items.
     *
     * @return  JDatabaseQuery
     */
    protected function getListQuery()
    {
        // Set the blog ordering
        $params             = $this->state->params;
        $articleOrderby     = $params->get('orderby_sec', 'rdate');
        $articleOrderDate   = $params->get('order_date');
        $categoryOrderby    = $params->def('orderby_pri', '');

        $secondary  = ContentHelperQuery::orderbySecondary($articleOrderby, $articleOrderDate) . ', ';
        $primary    = ContentHelperQuery::orderbyPrimary($categoryOrderby);

        $orderby = $primary . ' ' . $secondary . ' a.created DESC ';
        $this->setState('list.ordering', $orderby);
        $this->setState('list.direction', '');

        // Create a new query object.
        $query = parent::getListQuery();

        // Filter by categories
        $authorpostsCategories = $this->getState('filter.authorposts.categories');

        if (is_array($authorpostsCategories) && !in_array('', $authorpostsCategories))
        {
            $query->where('a.catid IN (' . implode(',', $authorpostsCategories) . ')');
        }

        return $query;

    }
}
