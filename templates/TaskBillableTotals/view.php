<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaskBillableTotal $taskBillableTotal
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Task Billable Total'), ['action' => 'edit', $taskBillableTotal->task_billable_total_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Task Billable Total'), ['action' => 'delete', $taskBillableTotal->task_billable_total_id], ['confirm' => __('Are you sure you want to delete # {0}?', $taskBillableTotal->task_billable_total_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Task Billable Totals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Task Billable Total'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="taskBillableTotals view content">
            <h3><?= h($taskBillableTotal->task_billable_total_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Task') ?></th>
                    <td><?= $taskBillableTotal->has('task') ? $this->Html->link($taskBillableTotal->task->task_id, ['controller' => 'Tasks', 'action' => 'view', $taskBillableTotal->task->task_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Task Billable Total Id') ?></th>
                    <td><?= $this->Number->format($taskBillableTotal->task_billable_total_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Task Total') ?></th>
                    <td><?= $this->Number->format($taskBillableTotal->task_total) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
