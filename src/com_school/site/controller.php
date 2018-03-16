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

// Import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * School Component Controller
 *
 * @since  1.5
 */
class SchoolController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   mixed    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return   JController This object to support chaining.
	 *
	 * @since    1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$view = JFactory::getApplication()->input->getCmd('view', 'students', 'teachers');

		if ( $view == 'teachers' )
		{
			$user = JFactory::getUser();
			$app  = JFactory::getApplication();

			if ($user->id == 0)
			{
				$app->redirect(JRoute::_('index.php?option=com_users&view=login'));
			}
		}

		JFactory::getApplication()->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}
}
