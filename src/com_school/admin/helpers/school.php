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
 * School helper.
 *
 * @since  1.6
 */
class SchoolHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  string
	 *
	 * @return void
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_SCHOOL_TITLE_STUDENTS'),
			'index.php?option=com_school&view=students',
			$vName == 'students'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_SCHOOL_TITLE_TEACHERS'),
			'index.php?option=com_school&view=teachers',
			$vName == 'teachers'
		);
	}
}
