<head>
    <title> Add New Employee </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<!-- <div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Employees'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="employees form content">
            <?= $this->Form->create($employee) ?>
            <fieldset>
                <legend><?= __('Add Employee') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('username');
                    echo $this->Form->control('password');
                    echo $this->Form->control('permission_level');

//  Security Questions for authentication and forgot password functionality
//  Removed for now as it is incomplete
//                    echo $this->Form->control('security_Question_1');
//                    echo $this->Form->control('security_Answer_1');
//                    echo $this->Form->control('security_Question_2');
//                    echo $this->Form->control('security_Answer_2');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->


<div class="page-title">
    <div class="col-12 col-md-6">
        <?= $this->Html->link(__('< Go back to employees list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    </div>
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add Employee</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                       

                        <!--<?= $this->Html->link(__('< Go back to employees list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>-->

                    </ol>
                </nav>
            </div>
        </div>

    </div>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">

                            <?= $this->Form->create($employee) ?>
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-4 offset-md-1 col-12">
                                        <div class="form-group">

                                             <?php
                                                echo $this->Form->control('first_name', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter first name', 'label' => 'First Name*']);
                                            ?>
                                        </div>
                                    </div>


                                    <div class="col-md-5 offset-md-1 col-12">
                                        <div class="form-group">


                                            <?php
                                            echo $this->Form->control('last_name', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter last name (Optional)', 'label' => 'Last Name']);
                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1 col-12">
                                        <div class="form-group">


                                            <?php
                                            echo $this->Form->control('username', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter username', 'label' => 'Username*']);
                                            ?>

                                        </div>
                                    </div>

                                    <div class="col-md-3 offset-md-2 col-12">
                                        <div class="form-group">


                                            <label for="first-name-column">PERMISSION LEVEL*</label>
                                            <?php

                                            $permission_level = array('employee' => 'employee', 'admin' => 'admin');

                                            echo $this->Form->select('permission_level', $permission_level, array
                                            ('class'=>'form-control form-control-user choices', 'placeholder' => 'Select permission level',
                                                'id' => 'permission_level', 'placeholder' => 'Permission level*', 'label' => 'Permission level*'))

                                            ?>

                                        </div>
                                    </div>

                                    <div class="col-md-3 offset-md-1 col-12">
                                        <div class="form-group">


                                            <?php
                                            echo $this->Form->control('password', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter password', 'label' => 'Password*']);
                                            ?>

                                            <?php
                                            echo "Password requires the following: <br>";
                                            echo "• a minimum of 8 characters <br>";
                                            echo "• at least 1 numerical character";
                                            ?>

                                        </div>
                                    </div>

<!--                                    //Security Questions for authentication and forgot password functionality-->
<!--                                    //Removed for now as it is incomplete-->
<!--                                    Security question 1-->
<!---->
<!--                                    <div class="col-md-3 offset-md-1 col-12">-->
<!--                                        <div class="form-group">-->
<!---->
<!--                                            --><?php
//                                            echo $this->Form->control('security_Question_1', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter First Security Question (required)', 'label' => 'Enter First Security Question*']);
//                                            ?>
<!--                                            -->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="col-md-3 offset-md-1 col-12">-->
<!--                                        <div class="form-group">-->
<!--                                            -->
<!--                                            --><?php
//                                            echo $this->Form->control('security_Answer_1', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter First Security Answer (required)', 'label' => 'Enter First Security Answer*']);
//                                            ?>
<!---->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    -->
<!--                                    Security question 2-->
<!--                                    <div class="col-md-3 offset-md-1 col-12">-->
<!--                                        <div class="form-group">-->
<!---->
<!--                                            --><?php
//                                            echo $this->Form->control('security_Question_2', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter Second Security Question (required)', 'label' => 'Enter Second Security Question*']);
//                                            ?>
<!--                                            -->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="col-md-3 offset-md-1 col-12">-->
<!--                                        <div class="form-group">-->
<!---->
<!---->
<!--                                            --><?php
//                                            echo $this->Form->control('security_Answer_2', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter Second Security Answer (required)', 'label' => 'Enter Second Security Answer*']);
//                                            ?>
<!---->
<!--                                        </div>-->
<!--                                    </div>-->








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
