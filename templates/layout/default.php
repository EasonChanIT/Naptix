<!DOCTYPE html>
<html lang="en">

<head>

    <?= $this->Html->charset() ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    


    <?= $this->Html->css('bootstrap.css') ?>

    <?= $this->Html->css('/vendors/simple-datatables/style.css') ?>

    <?= $this->Html->css('/vendors/chartjs/Chart.min.css') ?>

    <?= $this->Html->css('/vendors/choices.js/choices.min.css') ?>

    <?= $this->Html->css('/font-awesome/css/font-awesome.min.css') ?>

    <?= $this->Html->css('/vendors/perfect-scrollbar/perfect-scrollbar.css') ?>


    <?= $this->Html->css('app.css') ?>


    <?= $this->Html->meta('icon', $this->Url->build('/images/naptix-favicon.jpg')) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                  

                    <?php

                    echo $this->Html->image("/images/naptix-logo.png", [
                        "alt" => "Naptix",
                        'url' => ['controller' => 'EmployeeTasks', 'action' => 'newdashboard']
                    ]);

                    ?>


                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-item  ">
                            <a href="<?= $this->Url->build(['controller' => 'EmployeeTasks', 'action' => 'newdashboard']) ?>" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i>
                                <span>Dashboard</span>
                            </a>

                        </li>


                         <li class='sidebar-title'>Tasks</li>



                         <li class="sidebar-item  ">
                            <a href="<?= $this->Url->build(['controller' => 'EmployeeTasks', 'action' => 'index']) ?>" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i>
                                <span>Tasks rendered</span>
                            </a>

                        </li>

                        <!-- ADMIN ACCESS ONLY -->

                        <?php 

                        $permission = $this->Identity->get('permission_level');


                        if ($permission == 'admin') {?>

                            
                       <li class='sidebar-title'>Clients</li>

                        <li class="sidebar-item  ">
                            <a href="<?= $this->Url->build(['controller' => 'Clients', 'action' => 'index']) ?>" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i>
                                <span>Client List</span>
                            </a>

                        </li>

                        <li class='sidebar-title'>Admin</li>

                        <li class="sidebar-item  ">
                            <a href="<?= $this->Url->build(['controller' => 'Employees', 'action' => 'index']) ?>" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i>
                                <span>Employee List</span>
                            </a>

                        </li>

                                 <li class="sidebar-item  ">
                            <a href="<?= $this->Url->build(['controller' => 'Tasks', 'action' => 'index']) ?>" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i>
                                <span>Task (Admin)</span>
                            </a>

                        </li>

                         <?php } ?>


                        <!-- ADMIN ACCESS ENDS -->


                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">

                      <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, <?= $this->Identity->get('first_name') ?> (<?= $this->Identity->get('permission_level') ?>) </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'EmployeeTasks', 'action' => 'add']) ?>"><i data-feather="plus-circle"></i> Add New Task</a>
                                <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Employees', 'action' => 'logout']) ?>"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                       
                  
                    </ul>
                </div>
            </nav>

            <!-- main content starts here -->
            <div class="main-content container-fluid">
              <!-- page content here -->

              <?= $this->Flash->render() ?>
              <?= $this->fetch('content') ?>


            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Naptix</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?= $this->Html->script('/js/feather-icons/feather.min.js') ?>
    <?= $this->Html->script('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>
    <?= $this->Html->script('/js/app.js') ?>

    <?= $this->Html->script('/vendors/chartjs/Chart.min.js') ?>
    <?= $this->Html->script('/vendors/simple-datatables/simple-datatables.js') ?>
    <?= $this->Html->script('/js/vendors.js') ?>

    <?= $this->Html->script('/vendors/apexcharts/apexcharts.min.js') ?>
    <?= $this->Html->script('/js/pages/dashboard.js') ?>


    <!-- Include Choices JavaScript -->
    <?= $this->Html->script('/vendors/choices.js/choices.min.js') ?>

    <?= $this->Html->script('/js/main.js') ?>

</body>

</html>
