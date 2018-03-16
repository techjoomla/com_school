<?php
/**
 * @version    SVN: <svn_id>
 * @package    School
 * @author     Techjoomla <extensions@techjoomla.com>
 * @copyright  Copyright (c) 2009-2017 TechJoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Students view class
 */
class SchoolViewTeachers extends JViewLegacy
{
	/**
	 * The item authors
	 *
	 * @var  stdClass
	 */
	protected $authors;

	/**
	 * An array of items
	 *
	 * @var  array
	 */
	protected $items;

	/**
	 * The pagination object
	 *
	 * @var  JPagination
	 */
	protected $pagination;

	/**
	 * The model state
	 *
	 * @var  object
	 */
	protected $state;

	/**
	 * Form object for search filters
	 *
	 * @var  JForm
	 */
	public $filterForm;

	/**
	 * The active search filters
	 *
	 * @var  array
	 */
	public $activeFilters;

	/**
	 * The sidebar markup
	 *
	 * @var  string
	 */
	protected $sidebar;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
	{
		// Assign data to the view
		$this->msg = 'Hello World';

		// Get state
		$this->state = $this->get('State');

		// This calls model function getItems()
		$this->items = $this->get('Items');

		// Get pagination
		$this->pagination = $this->get('Pagination');

		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Get ACL actions
		$this->user            = JFactory::getUser();

		$this->canCreate       = $this->user->authorise('core.content.create', 'com_school');
		$this->canEdit         = $this->user->authorise('core.content.edit', 'com_school');
		$this->canCheckin      = $this->user->authorise('core.content.manage', 'com_school');
		$this->canChangeStatus = $this->user->authorise('core.content.edit.state', 'com_school');
		$this->canDelete       = $this->user->authorise('core.content.delete', 'com_school');

		// Add submenu
		SchoolHelper::addSubmenu('teachers');

		// Add oolbar
		$this->addToolbar();

		// Set sidebar
		$this->sidebar = JHtmlSidebar::render();

		// Display the view
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since    1.6
	 */
	protected function addToolbar()
	{
		$state = $this->get('State');

		JToolBarHelper::title(JText::_('COM_SCHOOL_TITLE_TEACHERS'), 'stack article');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/teacher';

		if (file_exists($formPath))
		{
			if ($this->canCreate)
			{
				JToolBarHelper::addNew('teacher.add', 'JTOOLBAR_NEW');
				JToolbarHelper::custom('teacher.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);
			}

			if ($this->canEdit && isset($this->items[0]))
			{
				JToolBarHelper::editList('teacher.edit', 'JTOOLBAR_EDIT');
			}
		}

		if ($this->canChangeStatus)
		{
			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::custom('teachers.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::custom('teachers.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}
			elseif (isset($this->items[0]))
			{
				// If this component does not use state then show a direct delete button as we can not trash
				JToolBarHelper::deleteList('', 'teachers.delete', 'JTOOLBAR_DELETE');
			}

			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::archiveList('teachers.archive', 'JTOOLBAR_ARCHIVE');
			}

			if (isset($this->items[0]->checked_out))
			{
				JToolBarHelper::custom('teachers.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
			}
		}

		// Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state))
		{
			if ($state->get('filter.state') == -2 && $this->canDelete)
			{
				JToolBarHelper::deleteList('', 'teachers.delete', 'JTOOLBAR_EMPTY_TRASH');
				JToolBarHelper::divider();
			}
			elseif ($this->canChangeStatus)
			{
				JToolBarHelper::trash('teachers.trash', 'JTOOLBAR_TRASH');
				JToolBarHelper::divider();
			}
		}
	}

	/**
	 * Method to order fields
	 *
	 * @return void
	 */
	protected function getSortFields()
	{
		return array(
			'a.id' => JText::_('JGRID_HEADING_ID'),
			'a.fname' => JText::_('COM_SCHOOL_STUDENT_FNAME'),
			'a.mobile' => JText::_('COM_SCHOOL_STUDENT_MOBILE'),
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.state' => JText::_('JSTATUS'),
		);
	}
}
