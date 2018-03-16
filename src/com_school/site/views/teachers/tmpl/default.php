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

// echo $this->msg;
// var_dump($this->items);
// print_r($this->items);

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

?>

<div class="tj-page">
	<div class="row-fluid">
		<form action="<?php echo JRoute::_('index.php?option=com_school&view=teachers'); ?>" method="post" name="adminForm" id="adminForm">
			<?php if (!empty( $this->sidebar)) : ?>
				<div id="j-sidebar-container" class="span2">
					<?php echo $this->sidebar; ?>
				</div>
				<div id="j-main-container" class="span10">
			<?php else : ?>
				<div id="j-main-container">
			<?php endif; ?>

					<?php
					// Search tools bar
					echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
					?>
					<br/>
					<div class="nav-pills">
						<span class="active">
							<a href="<?php echo JRoute::_('index.php?option=com_school&view=teacherform&layout=edit'); ?>" style="padding-top: 8px;     padding-bottom: 8px; margin-top: 2px; margin-bottom: 2px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #fff; background-color: #005e8d; padding-right: 12px; padding-left: 12px; margin-right: 2px; line-height: 14px;">
								<?php echo JText::_('JACTION_CREATE'); ?>
							</a>
						</span>
					</div>

					<table class="table table-striped" id="teachersList">
						<thead>
							<tr>
								<th width="1%" class="center">
									<?php echo JHtml::_('grid.checkall'); ?>
								</th>

								<th>
									<?php echo JHtml::_('searchtools.sort', 'COM_SCHOOL_TEACHERS_NAME', 'a.fname', $listDirn, $listOrder); ?>
								</th>

								<th>
									<?php echo JHtml::_('searchtools.sort', 'COM_SCHOOL_TEACHERS_CLASS', 'a.class', $listDirn, $listOrder); ?>
								</th>

								<th>
									<?php echo JHtml::_('searchtools.sort',  'COM_SCHOOL_TEACHERS_PHONE', 'a.mobile', $listDirn, $listOrder); ?>
								</th>
								<th>
									<?php echo JText::_('COM_SCHOOL_TEACHERS_ADDRESS'); ?>
								</th>
								<th>
									<?php echo JText::_('COM_SCHOOL_TEACHERS_ACTION'); ?>
								</th>
							</tr>
						</thead>

						<tbody>
							<?php
							foreach ($this->items as $i => $item)
							{
								$item->max_ordering = 0;
								$ordering   = ($listOrder == 'a.ordering');
							?>

								<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->class; ?>">
									<td class="center">
										<?php echo JHtml::_('grid.id', $i, $item->id); ?>
									</td>

									<td class="has-context">
										<div class="pull-left break-word">
												<a class="hasTooltip" href="<?php echo JRoute::_('index.php/teacher?view=teacher&layout=default&id=' . $item->id); ?>" title="<?php echo JText::_('COM_SCHOOL_TEACHERS_VIEW_DETAILS'); ?>">
													<?php echo $this->escape($item->fname . ' ' . $item->lname); ?></a>
										</div>
									</td>

									<td><?php echo $item->class; ?></td>
									<td><?php echo $item->mobile; ?></td>
									<td><?php echo $item->address; ?></td>
									<td>
										<a class="hasTooltip" href="<?php echo JRoute::_('index.php?option=com_school&view=teacherform&layout=edit&id=' . $item->id); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>"><?php echo JText::_('JACTION_EDIT'); ?></a>
									</td>
								</tr>

							<?php
							}
							?>
						<tbody>
					</table>

					<?php echo $this->pagination->getListFooter(); ?>

					<input type="hidden" name="task" value="" />
					<input type="hidden" name="boxchecked" value="0" />
					<?php echo JHtml::_('form.token'); ?>
			</div>
		</form>
	</div>
</div>
