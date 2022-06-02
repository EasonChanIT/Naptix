<head>
    <title> Add new task </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeTask $employeeTask
 * @var \Cake\Collection\CollectionInterface|string[] $employees
 * @var \Cake\Collection\CollectionInterface|string[] $tasks
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 */
?>
   <div class="page-title">
       <div class="col-12 col-md-6">
           <?= $this->Html->link(__('< Go back to tasks rendered list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
       </div>
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add Task Rendered</h3>
            </div>
           
        </div>

    </div>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">

                    <!-- ADMIN VERSION-->
                    <?php 

                        $permission = $this->Identity->get('permission_level');


                        if ($permission == 'admin') {?>

                    <div class="card-content">
                        <div class="card-body">

                            <?= $this->Form->create($employeeTask) ?>
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-2 offset-md-1 col-12">
                                        <div class="form-group">

                                             <?php
                                                echo $this->Form->control('date', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter date', 'label' => 'Date*']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 offset-md-1 col-12">
                                        <div class="md-form md-outline">


                                            <?php
                                            echo $this->Form->control('time', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter time', 'label' => 'Time*']);
                                            ?>

                                        </div> 

                                    </div>


                                    <div class="col-md-3 offset-md-1 col-12">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->control('billable_time', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter billable time (minutes)', 'label' => 'Billable time (minutes)*', 'id' => 'mySelect', 'onchange' => 'changeSubtotal()']);
                                            ?>

                                        </div>
                                    </div>

                                    <div class="col-md-3 offset-md-1 col-12">
                                        <div class="form-group">
                                           <?php
                                        echo $this->Form->control('client_id', ['class'=>'form-control form-control-user choices', 'placeholder'=>'Enter client id']);
                                        ?>
                                        </div>
                                    </div>

                                     <div class="col-md-3 offset-md-3 col-12">
                                        <div class="form-group">
                                           <?php
                                        echo $this->Form->control('employee_id', ['class'=>'form-control form-control-user choices', 'placeholder'=>'Enter employee id', 'label' => 'Employee*','id' => 'mySelect3', 'onchange' => 'changeSubtotal()']);
                                        ?>
                                        </div>
                                    </div>

                                    <div class="col-md-5 offset-md-1 col-12">
                                        <div class="form-group">
                                           <?php
                                        echo $this->Form->control('task_id', ['class'=>'form-control form-control-user choices', 'placeholder'=>'Enter task id', 'label' => 'Task*', 'id' => 'mySelect2', 'onchange' => 'changeSubtotal()']);
                                        ?>
                                        
                                        <p id="demo3">  </p> 
                                        </div>
                                    </div>

                                    
                                

                                    <div class="col-md-3 offset-md-1 col-12">
                                        <div class="form-group">
                                           <?php
                        echo $this->Form->control('subtotal', ['type' => 'integer', 'class'=>'form-control form-control-user', 'placeholder'=>'Automatic calculation', 'id' => 'subtotal_id','onchange'=>'changeSubtotal()']);
                                          
                        ?>
                                        </div>
                                    </div>

                                    <div class="col-md-5 offset-md-1 col-12">
                                        <div class="form-group">
                                                           <?php
                                        echo $this->Form->control('task_description', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter task description (Optional)']);
                                        ?>
                                                        </div>
                                                    </div>


                                   <div class="col-md-1 offset-md-1 col-12">

                                        <div class="form-group">


                                            <?php
                                            echo $this->Form->control('approval_status', ['type'=>'checkbox', 'class'=>'form-control form-control-user form-check-input', 'placeholder'=>'Enter no charge status']);
                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-md-1 col-12">
                                        <div class="form-group">
                                         <?php
                                            echo $this->Form->control('no_charge_status', ['type'=>'checkbox', 'class'=>'form-control form-control-user form-check-input', 'placeholder'=>'Enter no charge status']);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-1 col-12">

                                        <div class="form-group">


                                            <?php
                                            echo $this->Form->control('invoice_status', ['type'=>'checkbox', 'class'=>'form-control form-control-user form-check-input', 'placeholder'=>'Enter no invoice status']);
                                            ?>

                                        </div>
                                    </div>


                                     <div class="col-12 d-flex justify-content-end">

                                        <?php
                                            echo $this->Form->button('Save changes', ['type' => 'submit', 'class'=>'btn btn-outline-primary me-1 mb-1']);
                                        ?>


                                    </div>

                                    


                                </div>

                                </fieldset>

                                <?= $this->Form->end() ?>                      

                                <script>
                                    
                                    function changeSubtotal(value) {
                                        var employee_id = <?php echo ($employee_id);?>

                                        var obj = <?php echo json_encode($tasks_price); ?>;

                                        var bill_time = parseInt(document.getElementById("mySelect").value);
                                        var id_task = parseInt(document.getElementById("mySelect2").value);
                                        var id_employee = parseInt(document.getElementById("mySelect3").value);
                                        var rate_task = obj[id_task];
                                        var subtotal_calculation = 0;

                                        
                                        
                                        if(id_employee == employee_id){
                                            if(rate_task < 250){
                                                subtotal_calculation = (250 / 60) * bill_time ;
                                                document.getElementById("demo3").innerHTML = "Task rate per hour: $" + 250;
                                            }else{
                                                subtotal_calculation = (rate_task / 60) * bill_time ;
                                               
                                            }
                                            
                                        }else{
                                            subtotal_calculation = (rate_task / 60) * bill_time;
                                            document.getElementById("demo3").innerHTML = "Task rate per hour: $" + rate_task;
                                        }

                                        

                                        /*printing the subtotal calculation*/
                                        document.getElementById("subtotal_id").value = subtotal_calculation;
                                
                                        
                                        
                                    }


                                  
                                       
                                </script>

                              

                                <!-- ends here -->

                        </div>
                    </div>

                    <?php } ?>


                    <!-- EMPLOYEE VERSION-->

                    <?php 

                        $permission = $this->Identity->get('permission_level');


                        if ($permission != 'admin') {?>

                    <div class="card-content">
                        <div class="card-body">

                            <?= $this->Form->create($employeeTask) ?>
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-2 offset-md-1 col-12">
                                        <div class="form-group">

                                             <?php
                                                echo $this->Form->control('date', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter date', 'label' => 'Date*']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 offset-md-1 col-12">
                                        <div class="md-form md-outline">


                                            <?php
                                            echo $this->Form->control('time', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter time', 'label' => 'Time*']);
                                            ?>

                                        </div> 

                                    </div>


                                    <div class="col-md-3 offset-md-1 col-12">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->control('billable_time', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter billable time (minutes)', 'label' => 'Billable time (minutes)*', 'id' => 'mySelect', 'onchange' => 'changeSubtotal()']);
                                            ?>

                                        </div>
                                    </div>

                                    <div class="col-md-3 offset-md-1 col-12">
                                        <div class="form-group">
                                           <?php
                                        echo $this->Form->control('client_id', ['class'=>'form-control form-control-user choices', 'placeholder'=>'Enter client id']);
                                        ?>
                                        </div>
                                    </div>

                                     <div class="col-md-3 offset-md-3 col-12">
                                        <div class="form-group">
                                           <?php
                                        echo $this->Form->control('employee_id', ['class'=>'form-control form-control-user choices', 'placeholder'=>'Enter employee id', 'label' => 'Employee*']);
                                        ?>
                                        </div>
                                    </div>

                                    

                                    <div class="col-md-5 offset-md-1 col-12">
                                        <div class="form-group">
                                           <?php
                                        echo $this->Form->control('task_id', ['class'=>'form-control form-control-user choices', 'placeholder'=>'Enter task id', 'label' => 'Task*', 'id' => 'mySelect2', 'onchange' => 'changeSubtotal()']);
                                        ?>
                                        
                                        </div>
                                    </div>


                                    <div class="col-md-5 offset-md-1 col-12">
                                        <div class="form-group">
                                                           <?php
                                        echo $this->Form->control('task_description', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter task description (Optional)']);
                                        ?>
                                                        </div>
                                                    </div>


                                    <div class="col-md-3 offset-md-1 col-12">
                                        <div class="form-group">
                                           <?php
                        echo $this->Form->control('subtotal', ['type' => 'hidden', 'class'=>'form-control form-control-user', 'placeholder'=>'Enter subtotal (Optional)', 'id' => 'subtotal_id','onchange'=>'changeSubtotal()']);
                                          
                        ?>
                                        </div>
                                    </div>

                                  
                                  <div class="col-md-1 offset-md-1 col-12">

                                        <div class="form-group">


                                            <?php
                                            echo $this->Form->control('approval_status', ['type'=>'hidden', 'class'=>'form-control form-control-user form-check-input', 'placeholder'=>'Enter no charge status', 'value'=>'0']);
                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-md-1 col-12">
                                        <div class="form-group">
                                         <?php
                                            echo $this->Form->control('no_charge_status', ['type'=>'hidden', 'class'=>'form-control form-control-user form-check-input', 'placeholder'=>'Enter no charge status', 'value'=>'0']);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-1 col-12">

                                        <div class="form-group">


                                            <?php
                                            echo $this->Form->control('invoice_status', ['type'=>'hidden', 'class'=>'form-control form-control-user form-check-input', 'placeholder'=>'Enter no invoice status', 'value'=>'0']);
                                            ?>

                                        </div>
                                    </div>

                                     <div class="col-12 d-flex justify-content-end">

                                        <?php
                                            echo $this->Form->button('Save changes', ['type' => 'submit', 'class'=>'btn btn-outline-primary me-1 mb-1']);
                                        ?>


                                    </div>

                                    


                                </div>

                                </fieldset>

                                <?= $this->Form->end() ?>                      

                                <script>
                                    

                                    function changeSubtotal(value) {
                                        
                                        var obj = <?php echo json_encode($tasks_price); ?>;

                                        var bill_time = parseInt(document.getElementById("mySelect").value);
                                        var id_task = parseInt(document.getElementById("mySelect2").value);
                                        var rate_task = obj[id_task];

                                       
                                        var subtotal_calculation = (rate_task / 60) * bill_time;

                                        /*printing the subtotal calculation*/
                                        document.getElementById("subtotal_id").value = subtotal_calculation;

                                        //print task rate per hour
                                        document.getElementById("demo3").innerHTML = "Task rate per hour: $" + rate_task;
                                        
                                    }


                                  
                                       
                                </script>

                              

                                <!-- ends here -->

                        </div>
                    </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </section>



<script>
    var task_price = <?php echo json_encode($tasks_price) ?>
</script>