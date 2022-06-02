<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaskBillableTotal[]|\Cake\Collection\CollectionInterface $taskBillableTotals
 */
?>
<div class="taskBillableTotals index content">
    <?= $this->Html->link(__('New Task Billable Total'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Task Billable Totals') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('task_billable_total_id') ?></th>
                    <th><?= $this->Paginator->sort('task_total') ?></th>
                    <th><?= $this->Paginator->sort('task_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($taskBillableTotals as $taskBillableTotal): ?>
                <tr>
                    <td><?= $this->Number->format($taskBillableTotal->task_billable_total_id) ?></td>
                    <td><?= $this->Number->format($taskBillableTotal->task_total) ?></td>
                    <td><?= $taskBillableTotal->has('task') ? $this->Html->link($taskBillableTotal->task->task_id, ['controller' => 'Tasks', 'action' => 'view', $taskBillableTotal->task->task_id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $taskBillableTotal->task_billable_total_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $taskBillableTotal->task_billable_total_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $taskBillableTotal->task_billable_total_id], ['confirm' => __('Are you sure you want to delete # {0}?', $taskBillableTotal->task_billable_total_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
