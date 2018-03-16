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
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_school&task=teachers.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'teachersList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
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

					<table class="table table-striped" id="teachersList">
						<thead>
							<tr>
								<th width="1%" class="nowrap center hidden-phone">
									<?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
								</th>

								<th width="1%" class="center">
									<?php echo JHtml::_('grid.checkall'); ?>
								</th>

								<?php if (isset($this->items[0]->state)): ?>
									<th width="1%" class="nowrap center">
										<?php echo JHtml::_('grid.sort', 'JSTATUS', 'state', $listDirn, $listOrder); ?>
									</th>
								<?php endif; ?>

								<th>
									<?php echo JHtml::_('searchtools.sort', 'COM_SCHOOL_STUDENTS_NAME', 'a.fname', $listDirn, $listOrder); ?>
								</th>

								<th>
									<?php echo JHtml::_('searchtools.sort', 'COM_SCHOOL_STUDENTS_CLASS', 'a.class', $listDirn, $listOrder); ?>
								</th>

								<th>
									<?php echo JHtml::_('searchtools.sort',  'COM_SCHOOL_STUDENTS_PHONE', 'a.mobile', $listDirn, $listOrder); ?>
								</th>
								<th>
									<?php echo JText::_('COM_SCHOOL_STUDENTS_ADDRESS'); ?>
								</th>
								<th>
									<?php echo JHtml::_('searchtools.sort',  'COM_SCHOOL_STUDENTS_ID', 'a.id', $listDirn, $listOrder); ?>
								</th>
							</tr>
						</thead>

						<tbody>
							<?php
							foreach ($this->items as $i => $item)
							{
								$item->max_ordering = 0;
								$ordering   = ($listOrder == 'a.ordering');
								$canCreate  = $this->canCreate; //user->authorise('core.create',     'com_content.category.' . $item->catid);
								$canEdit    = $this->canEdit; // $user->authorise('core.edit',       'com_content.article.' . $item->id);

								$canCheckin = $this->canCheckin; //$user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
								// $canEditOwn = $user->authorise('core.edit.own',   'com_content.article.' . $item->id) && $item->created_by == $userId;

								$canChange  = $this->canChangeStatus; // $user->authorise('core.edit.state', 'com_content.article.' . $item->id) && $canCheckin;
								?>

								<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->class; ?>">
									<td class="order nowrap center hidden-phone">
										<?php
										$iconClass = '';

										if (!$canChange)
										{
											$iconClass = ' inactive';
										}
										elseif (!$saveOrder)
										{
											$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::_('tooltipText', 'JORDERINGDISABLED');
										}
										?>
										<span class="sortable-handler<?php echo $iconClass ?>">
											<span class="icon-menu" aria-hidden="true"></span>
										</span>
										<?php if ($canChange && $saveOrder) : ?>
											<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order" />
										<?php endif; ?>
									</td>

									<td class="center">
										<?php echo JHtml::_('grid.id', $i, $item->id); ?>
									</td>

									<?php if (isset($this->items[0]->state)): ?>
										<td class="center">
											<?php echo JHtml::_('jgrid.published', $item->state, $i, 'teachers.', $canChange, 'cb'); ?>
										</td>
									<?php endif; ?>

									<td class="has-context">
										<div class="pull-left break-word">
											<?php if ($item->checked_out) : ?>
												<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'teachers.', $canCheckin); ?>
											<?php endif; ?>

											<?php if ($canEdit || $canEditOwn) : ?>
												<a class="hasTooltip" href="<?php echo JRoute::_('index.php?option=com_school&task=teacher.edit&id=' . $item->id); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
													<?php echo $this->escape($item->fname . ' ' . $item->lname); ?></a>
											<?php else : ?>
												<span><?php echo $this->escape($item->fname . ' ' . $item->lname); ?></span>
											<?php endif; ?>
										</div>
									</td>

									<td><?php echo $item->class; ?></td>
									<td><?php echo $item->mobile; ?></td>
									<td><?php echo $item->address; ?></td>
									<td><?php echo $item->id; ?></td>
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
