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

JHtml::_('behavior.tooltip');
?>

<div class="">
		<div class="form-horizontal">
			<div class="row-fluid">
				<div class="span12 form-horizontal">
					<fieldset class="adminform">

						<div class="control-group">
							<div class="control-label">
								<?php echo JText::_('COM_SCHOOL_FORM_LBL_TEACHER_FNAME'); ?>
							</div>
							<div class="controls">
								<?php echo $this->item->fname; ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo JText::_('COM_SCHOOL_FORM_LBL_TEACHER_MNAME'); ?>
							</div>
							<div class="controls">
								<?php echo $this->item->mname; ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo JText::_('COM_SCHOOL_FORM_LBL_TEACHER_LNAME'); ?>
							</div>
							<div class="controls">
								<?php echo $this->item->lname;?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo JText::_('COM_SCHOOL_FORM_LBL_TEACHER_CLASS'); ?>
							</div>
							<div class="controls">
								<?php echo $this->item->class;?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo JText::_('COM_SCHOOL_FORM_LBL_TEACHER_MOBILE'); ?>
							</div>
							<div class="controls">
								<?php echo $this->item->mobile;?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo JText::_('COM_SCHOOL_FORM_LBL_TEACHER_ADDRESS'); ?>
							</div>
							<div class="controls">
								<?php echo $this->item->address;?>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
</div>
