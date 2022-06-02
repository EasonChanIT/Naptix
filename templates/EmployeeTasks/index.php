<head>
<script src="https://kit.fontawesome.com/9e5ca48af8.js" crossorigin="anonymous"></script>
    <title> View tasks rendered </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeTask[]|\Cake\Collection\CollectionInterface $employeeTasks
 */
?>

<style>
    .font_color {
        color: red !important;
    }
    
</style>

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tasks Rendered </h3>

        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <?= $this->Html->link(__('Add New Task Rendered'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
                </ol>
            </nav>
        </div>
    </div>

</div>

<section class="section">
    <div class="card">

        <div class="card-body">
            
            <h4>Filter</h4>

                <!-- ADMIN VERSION-->
                        <?= $this->Form->create(null, ['method' => 'GET']) ?>
                         <?php 

                        $permission = $this->Identity->get('permission_level');


                        if ($permission == 'admin') {?>

                <div class="row">

                    <div class="col-md-2 col-12 offset-md-1">
                    <p>Start Date</p>
                        <div class="form-group">

                            <?php
                            echo $this->Form->date('begin', ['class' => 'form-control form-control-user','value'=>$begin]);
                            ?>
                        </div>
                    </div >

                    <div class="col-md-2 col-12">
                    <p>End Date</p>
                        <div class="form-group">
                            <?php
                            echo $this->Form->date('end', ['class' => 'form-control form-control-user','value'=>$end]);
                            ?>
                        </div>
                    </div>


                    

                    <div class="col-md-3 ">
                        <div class="form-group">
                            <?php


                                        echo $this->Form->control('employee_id', ['class'=>'form-control form-control-user choices', 'value'=> $selected_employee, 'empty'=> 'Show all']);
                                        ?>
                        </div>
                    </div>

                    
                    <div class="col-md-3 ">
                        <div class="form-group">
                            <?php
                                        echo $this->Form->control('client_id', ['class'=>'form-control form-control-user choices', 'value' => $selected_client, 'empty'=> 'Show all']);
                                        
                                        ?>
                        </div>
                    </div>

                    <div class="col-md-5 offset-md-1">
                        <div class="form-group">
                            <?php

                                       

                                        echo $this->Form->control('task_id', ['class'=>'form-control form-control-user choices', 'value'=>$selected_task, 'empty'=> 'Show all']);
                                        ?>
                        </div>
                    </div>


                    

                    <div class="col-md-1 col-12 ">
                        <div class="form-group">
                            <?php
                                            echo $this->Form->control('invoice_status', ['label' => 'Invoiced', 'type'=>'checkbox', 'class'=>'form-control form-control-user form-check-input', 'checked'=> $invoice_check]);
                                            ?>

                        </div>
                    </div>

                    <div class="col-md-1 ">
                        <div class="form-group">
                             <?php
                                            echo $this->Form->control('approval_status', ['label' => 'Approved', 'type'=>'checkbox', 'class'=>'form-control form-control-user form-check-input', 'checked'=>$approval_check]);
                                            ?>

                        </div>
                    </div>

                    

                    <div class="col-md-1 ">
                    &nbsp;
                        <div class="form-group">
                            <?php
                            echo $this->Form->control('Search', ['type' => 'submit', 'class' => 'btn btn-outline-primary me-1 mb-1']);
                            
                            echo $this->Form->end()
                            ?>
                            <?php $oldUrl = $_SERVER["REQUEST_URI"] ?>
                            <?php $basic =  strtok($_SERVER["REQUEST_URI"],'?')?>
                            <?php $newUrl = str_replace($basic,$basic.'/pdf',$oldUrl) ?>
        
                            <a href= <?php echo $newUrl?> >save as pdf</a>
                            
                            
                        </div>

                    </div>

                </div>
                <?php } ?>

                <!-- EMPLOYEE VERSION-->

                         <?php 

                        $permission = $this->Identity->get('permission_level');


                        if ($permission != 'admin') {?>

                <div class="row">

                    <div class="col-md-2 col-12 offset-md-2">
                    <p>Start Date</p>
                        <div class="form-group">

                            <?php
                            echo $this->Form->date('begin', ['class' => 'form-control form-control-user','value'=>$begin]);
                            ?>
                        </div>
                    </div >

                    <div class="col-md-2 col-12">
                    <p>End Date</p>
                        <div class="form-group">
                            <?php
                            echo $this->Form->date('end', ['class' => 'form-control form-control-user', 'value'=>$end]);
                            ?>
                        </div>
                    </div>


                    
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <?php
                                        echo $this->Form->control('client_id', ['class'=>'form-control form-control-user choices', 'value'=>$selected_client, 'empty'=> 'Show all']);
                                        ?>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-2">
                        <div class="form-group">
                            <?php

                                       

                                        echo $this->Form->control('task_id', ['class'=>'form-control form-control-user choices', 'value'=>$selected_task, 'empty'=> 'Show all']);
                                        ?>
                        </div>
                    </div>


                    


                    <div class="col-md-1 ">
                    &nbsp;
                        <div class="form-group">
                            <?php
                            echo $this->Form->control('Search', ['type' => 'submit', 'class' => 'btn btn-outline-primary me-1 mb-1']);
                            ?>

                           
                        </div>
                            
                    </div>

                </div>
                <?php } ?>

            <?php echo $this->Form->end() ?>
            <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Employee</th>
                                <th>Task</th>
                                <th>Client</th>
                                <th>Billable Time</th>
                                <th>Invoice status</th>
                                <?php 

                        $permission = $this->Identity->get('permission_level');


                        if ($permission == 'admin') {?>

                                <th>Subtotal</th>

                                <?php } ?>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $this->Form->create() ?>
                            <?php foreach ($employeeTasks as $employeeTask): ?>
                                <tr>
                                    
                                    <td><?= h($employeeTask->date) ?></td>
                                    <td><?= h($employeeTask->employee->first_name) ?></td>
                                    <td><?= h($employeeTask->task->task_name) ?></td>
                                    <td><?= h($employeeTask->client->company_name) ?></td>
                                    <td><?= h($employeeTask->billable_time) ?> mins</td>
                                    <td><?php
                                    if ($employeeTask->invoice_status == 1) { ?>
                                        <i class="fa fa-check"></i>
                                        
                                    <?php } else {?>
                                        <i class="fa fa-xmark"></i>
                                        <?= $this->Form->postlink('',['action'=>'update',$employeeTask->employee_tasks_id],['class' => "fa-solid fa-clipboard-check"]) ?>
                                    <?php } ?>
                                    </td>
                                    <?php 

                        $permission = $this->Identity->get('permission_level');


                        if ($permission == 'admin') {?>

                                    <td>$<?= $this->Number->format($employeeTask->subtotal) ?></td>

                                  
                                  <?php } ?>
                                    <td class="actions">

                                        <?= $this->Html->link('', ['action' => 'view', $employeeTask->employee_tasks_id], ['class' => 'fa fa-eye', 'style'=> 'margin-right: 10px']) ?>
                                        
                                                                          
                                        <?= $this->Html->link('', ['action' => 'edit', $employeeTask->employee_tasks_id], ['class' => 'fa fa-pencil-square-o', 'style' => 'margin-right: 10px']) ?>
                                        <?= $this->Form->postLink('', ['action' => 'delete', $employeeTask->employee_tasks_id], ['confirm' => __('Are you sure you want to delete {0} for {1} dated on {2}?', $employeeTask->task->task_name, $employeeTask->client->company_name, $employeeTask->date), 'class' => 'font_color fa fa-trash-o']) ?>
                                    </td>
                                </tr>
                                
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <?php echo $this->Form->end() ?>
                    <div class="">
                        <ul class="pagination justify-content-center">
                            <?php $this->Paginator->setTemplates([
                                'first' => '<li class="page-item">
                                                    <a class="page-link" href="{{url}}" >
                                                    <span aria-hidden="true">{{text}}</span>
                                                  </a>
                                                </li>',
                                'prevActive'=>'<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                'prevDisabled'=>'<li class="page-item disabled"><a onclick="return false" class="page-link" href="{{url}}">{{text}}</a></li>',
                                'number'=>'<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                'current'=>'<li class="page-item active"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                'nextActive'=>'<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                'nextDisabled'=>'<li class="page-item disabled"><a onclick="return false" class="page-link" href="{{url}}">{{text}}</a></li>',
                                'last' => '<li class="page-item">
                                                    <a class="page-link" href="{{url}}" >
                                                    <span aria-hidden="true">{{text}}</span>
                                                  </a>
                                                </li>',
                            ]);?>
                            <?= $this->Paginator->first('<<',['class'=>'page-item']) ?>
                            <?= $this->Paginator->prev('<') ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next('>') ?>
                            <?= $this->Paginator->last('>>') ?>
                        </ul>
                       

                        <p><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}') ?></p>
                        
                    </div>
        </div>
    </div>
                            
</section>


<?= $this->Html->script('/js/jquery-2.1.1.min.js') ?>



