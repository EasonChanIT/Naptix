<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaskBillableTotal $taskBillableTotal
 * @var string[]|\Cake\Collection\CollectionInterface $tasks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $taskBillableTotal->task_billable_total_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $taskBillableTotal->task_billable_total_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Task Billable Totals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="taskBillableTotals form content">
            <?= $this->Form->create($taskBillableTotal) ?>
            <fieldset>
                <legend><?= __('Edit Task Billable Total') ?></legend>
                <?php
                    echo $this->Form->control('task_total');
                    echo $this->Form->control('task_id', ['options' => $tasks]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
