<head>
    <title>View Employee </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>

<div class="page-title">
    <div class="col-12 col-md-6">
        <?= $this->Html->link(__('< Go back to employees list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    </div>
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= h($employee->first_name) ?>'s Profile Details</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="<?= $this->Url->build(['controller' => 'Employees', 'action' => 'index']) ?>">Employee List</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= h($employee->first_name) ?> Details</li> -->

                        <!--<?= $this->Html->link(__('< Go back to employees list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>-->

                    </ol>
                </nav>
            </div>
        </div>

    </div>



<div class="card">

              <div class="card-content">
                <div class="card-body">

                  <!-- Table with outer spacing -->
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tbody>


                        <tr>
                          <td class="text-bold-500"><?= __('First Name') ?></td>
                          <td><?= h($employee->first_name) ?></td>

                        </tr>


                        <tr>
                          <td class="text-bold-500"><?= __('Last Name') ?></td>
                          <td><?= h($employee->last_name) ?></td>

                        </tr>

                        <tr>
                            <td class="text-bold-500"><?= __('Username') ?></td>
                            <td><?= h($employee->username) ?></td>

                        </tr>

                        <tr>
                          <td class="text-bold-500"><?= __('Permission Level') ?></td>
                          <td><?= h($employee->permission_level) ?></td>
                        </tr>


<!--                        //Security Questions for authentication and forgot password functionality-->
<!--                        //Removed for now as it is incomplete-->
                     <!--   <tr>
                            <td class="text-bold-500"><?/*= __('Security Question 1') */?></td>
                            <td><?/*= h($employee->security_Question_1) */?></td>
                        </tr>

                        <tr>
                            <td class="text-bold-500"><?/*= __('Security Answer 1') */?></td>
                            <td><?/*= h($employee->security_Answer_1) */?></td>
                        </tr>

                        <tr>
                            <td class="text-bold-500"><?/*= __('Security Question 2') */?></td>
                            <td><?/*= h($employee->security_Question_2) */?></td>
                        </tr>

                        <tr>
                            <td class="text-bold-500"><?/*= __('Security Answer 1') */?></td>
                            <td><?/*= h($employee->security_Answer_1) */?></td>
                        </tr>-->



                      </tbody>
                    </table>

                  </div>

                    <div class="col-12 d-flex justify-content-end">

                        <?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->employee_id], ['class' => 'btn btn-outline-primary me-1 mb-1']) ?>

                        <?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->employee_id], ['confirm' => __('Are you sure you want to delete {0}?', $employee->first_name), 'class' => 'btn btn-outline-danger me-1 mb-1']) ?>


                    </div>

                </div>
              </div>
            </div>





