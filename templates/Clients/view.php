<head>
    <title> View Client </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>

    <div class="page-title">
        <div class="col-12 col-md-6">
            <?= $this->Html->link(__('< Go back to client list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                 <h3><?= h($client->company_name) ?>'s Tasks Rendered</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                      <!--
                        <li class="breadcrumb-item"><a href="<?= $this->Url->build(['controller' => 'Clients', 'action' => 'index']) ?>">Client List</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= h($client->company_name) ?> Details</li>

                      -->

                       <!--<?= $this->Html->link(__('< Go back to client list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>-->

                    </ol>
                </nav>
            </div>
        </div>

    </div>




<!-- DISPLAYS TASK FOR EACH CLIENT -->






<section class="section">
                    <div class="card">

                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                            <thead>
                            <div class="col-12 d-flex justify-content-end">

                                <?= $this->Html->link(__('Add Task'), ['controller' => 'EmployeeTasks','action' => 'add2',$client->client_id],['class' => 'btn btn-outline-primary me-1 mb-1']) ?>


                                <?= $this->Html->link(__('Edit Client'), ['action' => 'edit', $client->client_id], ['class' => 'btn btn-outline-primary me-1 mb-1']) ?>

                                <?= $this->Form->postLink(__('Delete Client'), ['action' => 'delete', $client->client_id], ['confirm' => __('Are you sure you want to delete {0}?', $client->company_name), 'class' => 'btn btn-outline-danger me-1 mb-1']) ?>


                            </div>
                <tr>

                    <th><?= $this->Paginator->sort('Date') ?></th>

                    <!-- <th><?= $this->Paginator->sort('Task') ?></th> -->
                    <th><?= $this->Paginator->sort('Task Description') ?></th>
                    <th><?= $this->Paginator->sort('Subtotal ($)') ?></th>
                    <th><?= $this->Paginator->sort('Billable time') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>

                    <!-- <th><?= $this->Paginator->sort('Employee') ?></th> -->

                </tr>
            </thead>
            <tbody>


            <?php foreach ($employeetasks as $employeeTask): ?>

                <tr>
                    <td><?= h($employeeTask->date) ?></td>
                    <!-- <td><?= $employeeTask->has('task') ? $this->Html->link($employeeTask->task->task_id, ['controller' => 'Tasks', 'action' => 'view', $employeeTask->task->task_id]) : '' ?></td> -->

                    <td><?= h($employeeTask->task_description) ?></td>
                    <td><?= $this->Number->format($employeeTask->subtotal) ?></td>

                    <td><?= $this->Number->format($employeeTask->billable_time) ?></td>

                    <td class="actions">
                    <!-- <?= $employeeTask->has('task') ? $this->Html->link(__('Edit'), ['controller' => 'Tasks', 'action' => 'edit', $employeeTask->task->task_id]) : '' ?> -->
                        <?= $this->Html->link(__('View'), ['controller' => 'EmployeeTasks','action' => 'view', $employeeTask->employee_tasks_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'EmployeeTasks','action' => 'edit', $employeeTask->employee_tasks_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'EmployeeTasks','action' => 'delete', $employeeTask->employee_tasks_id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeTask->employee_tasks_id)]) ?>
                    </td>
                    <!-- <td><?= $employeeTask->has('employee') ? $this->Html->link($employeeTask->employee->employee_id, ['controller' => 'Employees', 'action' => 'view', $employeeTask->employee->employee_id]) : '' ?></td> -->

                </tr>
            <?php endforeach; ?>
            </tbody>
                            </table>

                    </div>

                </section>
