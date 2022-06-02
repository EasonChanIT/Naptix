<head>
    <title> View task rendered </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeTask $employeeTask
 */
?>
<div class="page-title">
    <div class="col-12 col-md-6">
        <?= $this->Html->link(__('< Go back to tasks rendered list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    </div>
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Task #<?= h($employeeTask->employee_tasks_id) ?> Details</h3>
            </div>
            
        </div>



    </div>


<div class="card">

    <div class="card-content">
        <div class="card-body">
            <style type="text/css">
                 .my_table{width:100%;margin-bottom:50px;}
                 .my_table td{height:55px;line-height:55px;}
                 .my_table td .bk{width:60%;padding-left:20px;height:40px;line-height:40px;}
                 .bk{border:1px solid #eee;border-radius:10px;}
            </style>
            <!-- Table with outer spacing -->
            <div class="table-responsive">
                <table border="0" class="my_table">
                    <tr>
                        <td width="10%"><?= __('Client Name') ?></td>
                        <td width="40%"><div class="bk"><?= h($employeeTask->client->company_name) ?></div></td>
                        <td width="10%"><?= __('Subtotal') ?></td>
                        <td width="40%"><div class="bk"><?= h($employeeTask->subtotal) ?></div></td>
                    </tr>
                    <tr>
                        <td width="10%"><?= __('Date') ?></td>
                        <td width="40%"><div class="bk"><?= h($employeeTask->date) ?></div></td>
                        <td width="10%"><?= __('Time') ?></td>
                        <td width="40%"><div class="bk"><?= h($employeeTask->date) ?></div></td>
                    </tr>
                    <tr>
                        <td width="10%"><?= __('Employee') ?></td>
                        <td width="40%"><div class="bk"><?= h($employeeTask->employee->first_name) ?></div></td>
                        <td width="10%">Billable Time</td>
                        <td width="40%"><div class="bk"><?= h($employeeTask->billable_time) ?></div></td>
                    </tr>
                    
                    <!-- ADMIN VERSION-->
                    <?php 

                        $permission = $this->Identity->get('permission_level');


                        if ($permission == 'admin') {?>

                    <tr>
                        <td width="10%"><?= __('Approved') ?></td>
                        <td width="40%"><div class="bk"><?= $employeeTask->approval_status ? __('Yes') : __('No'); ?></div></td>
                       
                        <td width="10%"><?= __('Invoiced') ?></td>
                        <td width="40%"><div class="bk"><?= $employeeTask->invoice_status ? __('Yes') : __('No'); ?></div></td>
                    </tr>

                    <tr>
                        <td width="20%"><?= __('No Charge Status') ?></td>
                        <td width="30%"><div class="bk"><?= $employeeTask->no_charge_status ? __('Yes') : __('No'); ?></div></td>
                    </tr>

                    <?php } ?>
                    
                    <tr>
                        <td width="10%"><?= __('Task Name') ?></td>
                        <td width="40%"><div class="bk" style="width:50%;"><?= h($employeeTask->task->task_name) ?></div></td>
                    </tr>
                    <tr>
                        <td colspan="1" style="vertical-align: top">Task Description</td>
                        <td colspan="3"><div class="bk" style="width:50%;height:auto;"><?= h($employeeTask->task_description) ?></div></td>
                    </tr>
                </table>


            </div>

            <div class="col-12 d-flex justify-content-end">

                <?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $employeeTask->employee_tasks_id], ['class' => 'btn btn-outline-primary me-1 mb-1']) ?>

                <?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $employeeTask->employee_tasks_id], ['confirm' => __('Are you sure you want to delete {0} for {1} dated on {2}?', $employeeTask->task->task_name, $employeeTask->client->company_name, $employeeTask->date), 'class' => 'btn btn-outline-danger me-1 mb-1']) ?>


            </div>

        </div>
    </div>
</div>


                </div>
              </div>
            </div>
