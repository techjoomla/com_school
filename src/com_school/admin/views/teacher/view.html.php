<?php
/**
 * @version    SVN: <svn_id>
 * @package    Tjfields
 * @author     Techjoomla <extensions@techjoomla.com>
 * @copyright  Copyright (c) 2009-2015 TechJoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

/**
 * View class for editing teacher.
 *
 * @package     Tjfields
 * @subpackage  com_tjfields
 * @since       2.2
 */
class SchoolViewTeacher extends JViewLegacy
{
	protected $state;

	protected $item;

	protected $form;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('State');
		$this->item  = $this->get('Item');

		//print_r($this->item);

		$this->form  = $this->get('Form');

		//print_r($this->form);


		$this->input = JFactory::getApplication()->input;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		// Get ACL actions
		$this->user            = JFactory::getUser();

		$this->canCreate       = $this->user->authorise('core.content.create', 'com_school');
		$this->canEdit         = $this->user->authorise('core.content.edit', 'com_school');
		$this->canCheckin      = $this->user->authorise('core.content.manage', 'com_school');
		$this->canChangeStatus = $this->user->authorise('core.content.edit.state', 'com_school');
		$this->canDelete       = $this->user->authorise('core.content.delete', 'com_school');

		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user = JFactory::getUser();
		$isNew = ($this->item->id == 0);

		if ($isNew)
		{
			$viewTitle = JText::_('COM_SCHOOL_ADD_TEACHER');
		}
		else
		{
			$viewTitle = JText::_('COM_SCHOOL_EDIT_TEACHER');
		}

		JToolBarHelper::title($viewTitle, 'pencil-2');

		if (isset($this->item->checked_out))
		{
			$checkedOut = ! ($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		}
		else
		{
			$checkedOut = false;
		}

		// If not checked out, can save the item.
		if (! $checkedOut && ($this->canEdit || $this->canCreate))
		{
			JToolBarHelper::apply('teacher.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('teacher.save', 'JTOOLBAR_SAVE');
		}

		if (empty($this->item->id))
		{
			JToolBarHelper::cancel('teacher.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			JToolBarHelper::cancel('teacher.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
