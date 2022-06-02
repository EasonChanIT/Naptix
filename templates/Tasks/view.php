<head>
    <title>View Task </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
?>

<!--Title-->
<div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= h($task->task_name) ?> Details</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <?= $this->Html->link(__('< Go back to tasks list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

<!--Page Content-->
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <!-- Table with outer spacing -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td class="text-bold-500"><?= __('Task Name') ?></td>
                        <td><?= h($task->task_name) ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold-500"><?= __('Task Rate') ?></td>
                        <td><?= h($task->task_rate) ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-12 d-flex justify-content-end">
                <?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $task->task_id], ['class' => 'btn btn-outline-primary me-1 mb-1']) ?>
                <?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $task->task_id], ['confirm' => __('Are you sure you want to delete {0}?', $task->task_name), 'class' => 'btn btn-outline-danger me-1 mb-1']) ?>
            </div>
        </div>
    </div>
</div>

