<head>
    <title>Edit Task </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
?>


<div class="page-title">
    <div class="col-12 col-md-6">
        <?= $this->Html->link(__('< Go back to tasks list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    </div>
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit <?= h($task->task_name) ?> Details</h3>
            </div>
            
        </div>

    </div>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">

                            <?= $this->Form->create($task) ?>
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-5 offset-md-1 col-12">
                                        <div class="form-group">

                                             <?php
                                                echo $this->Form->control('task_name', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter task name', 'label' => 'Task Name*']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1 col-12">
                                        <div class="form-group">


                                            <?php
                                            echo $this->Form->control('task_rate', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter task rate', 'label' => 'Task Rate*']);
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


