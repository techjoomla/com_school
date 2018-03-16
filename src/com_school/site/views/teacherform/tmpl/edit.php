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
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'teacherform.cancel')
		{
			Joomla.submitform(task, document.getElementById('teacher-form'));
		}
		else
		{
			if (task != 'teacherform.cancel' && document.formvalidator.isValid(document.id('teacher-form')))
			{
				Joomla.submitform(task, document.getElementById('teacher-form'));
			}
			else
			{
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<div class="">
	<form action="" method="post" enctype="multipart/form-data" name="teacher-form" id="teacher-form" class="form-validate">

		<div class="form-horizontal">
			<div class="row-fluid">
				<div class="span12 form-horizontal">
					<fieldset class="adminform">

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('id'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('id'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('fname'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('fname'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('mname'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('mname'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('lname'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('lname'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('class'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('class'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('mobile'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('mobile'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<?php echo $this->form->getLabel('address'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('address'); ?>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<a type="button" class="btn btn-primary validate" onclick="Joomla.submitbutton('teacherform.save');">
					<?php echo JText::_('JSUBMIT'); ?>
				</a>
					<a class="btn"
						href="<?php echo JRoute::_('index.php?option=com_school&view=teachers'); ?>"
						title="<?php echo JText::_('JCANCEL'); ?>">
					<?php echo JText::_('JCANCEL'); ?>
				</a> <input type="hidden" name="option" value="com_school" />
				<input
						type="hidden" name="controller" value="teacherform" />
									<input type="hidden" name="view" value="teacherform" />

				</div>
			</div>
			<input type="hidden" name="jform[user_id]" value="<?php echo JFactory::getUser()->id; ?>"/>
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
