<head>
    <title> Naptix Dashboard </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<h1> Welcome to your Dashboard, <?= $this->Identity->get('first_name') ?> </h1>
<!-- chart part-->

<body>

    <section class="section">
        <div class="row row-cols-2">
            <div class="col">
                <div class="card">
                    <canvas id="myChart4"></canvas>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <canvas id="myChart5"></canvas>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <canvas id="myChart3"></canvas>
                </div>
            </div>
        </div>
    </section>


    <script>
        let myChart = document.getElementById('myChart').getContext('2d');
        let myChart3 = document.getElementById('myChart3').getContext('2d');

        //Global settings options
        //Chart.defaults.global.defaultFontFamily:'Lato';
        // Chart.defaults.global.defaultFontSize:18;
        // Chart.defaults.global.defaultFontColor:'#777';


        //chart one (tasks not approved)
        let xAxisUnapprovedTasks = <?php echo json_encode($unApprovedTasks) ?> ;
        let unApprovedData = xAxisUnapprovedTasks[xAxisUnapprovedTasks.length - 1];

        //chart two (top clients approved hours)
        let xAxisTopClients = <?php echo json_encode($topClientOutput) ?> ;
        let topClientData = xAxisTopClients[xAxisTopClients.length - 1];

        let outstandingHoursChart = new Chart(myChart, {
            type: 'bar', // bar, horizontalBar, pie, line, doughnut, radarm, polarArea
            data: {
                labels: <?php echo json_encode($nameArray) ?> ,
                datasets: [{
                        label: 'Un-Approved Tasks',
                        data: unApprovedData,
                        backgroundColor: 'rgba(237, 237, 83, 0.6)',
                        borderWidth: 1,
                        borderColor: '#777',
                        hoverBorderWidth: 3,
                        hoverBorderColor: '#000'
                    },
                    {
                        label: 'Un-Approved Hours',
                        data: <?php echo json_encode($hoursUnapprovedArray)?>,
                        backgroundColor: 'rgba(242, 80, 218, 0.6)',
                        borderWidth: 1,
                        borderColor: '#777',
                        hoverBorderWidth: 3,
                        hoverBorderColor: '#000'
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                plugins: {
                    title: {
                        display: true,
                        text: 'Number of Tasks to be Approved by Employee',
                    },
                    legend: {
                        display: false
                    }
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        bottom: 10,
                        top: 10
                    }
                },
                tooltips: {
                    enabled: false
                }
            }
        });

        let taskChart = new Chart(myChart3, {
            type: 'pie', // bar, horizontalBar, pie, line, doughnut, radarm, polarArea
            data: {
                labels: <?php echo json_encode($topClientLabelArray)?> ,
                datasets: [{
                    label: 'revenue',
                    data: topClientData,
                    //backgroundColor:'rgba(93, 158, 254, 0.6)',
                    backgroundColor: [
                        'rgba(100, 240, 72, 0.7)',
                        'rgba(54, 130, 39, 0.7)',
                        'rgba(50, 150, 148, 0.7)',
                        'rgba(79, 240, 236, 0.7)',
                        'rgba(40, 123, 125, 0.7)',
                        'rgba(98, 83, 237, 0.7)',
                        'rgba(50, 42, 128, 0.7)',
                        'rgba(217, 74, 217, 0.7)',
                        'rgba(94, 33, 94, 0.7)',
                        'rgba(201, 32, 128, 0.7)'
                    ],
                    borderWidth: 1,
                    borderColor: '#777',
                    hoverBorderWidth: 3,
                    hoverBorderColor: '#000'
                }]
            },
            options: {
                indexAxis: 'y',
                plugins: {
                    title: {
                        display: true,
                        text: 'Time Approved Top Clients',
                    },
                    legend: {
                        display: true
                    }

                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        bottom: 10,
                        top: 10
                    }
                },
                tooltips: {
                    enabled: false
                }
            }
        });

        let revChart = new Chart(myChart4, {
            type: 'bar',
            data: {
                labels: [ <?php echo($currentMonthInt) ?> , 'Q1', 'Q2', 'Q3', 'Q4', 'Yr'],
                datasets: [{
                    label: 'Time Approved (hours)',
                    data: [ <?php echo($monthTimeOutput)?>,
                            <?php echo($q1TimeOutput) ?>,
                            <?php echo($q2TimeOutput) ?>,
                            <?php echo($q3TimeOutput) ?>,
                            <?php echo($q4TimeOutput) ?>,
                            <?php echo($yearTimeOutput) ?>
                    ],
                    backgroundColor: [
                        'rgba(138, 154, 249, 0.6)',
                        'rgba(198, 204, 81, 0.6)',
                        'rgba(175, 84, 87, 0.6)',
                        'rgba(106, 15, 206, 0.6)',
                        'rgba(145, 154, 150, 0.6)',
                        'rgba(27, 230, 40, 0.6)'
                    ],
                    borderWidth: 1,
                    borderColor: '#777',
                    hoverBorderWidth: 3,
                    hoverBorderColor: '#000'
                }, ]
            },
            options: {
                indexAxis: 'y',
                plugins: {
                    title: {
                        display: true,
                        text: 'Time Approved By Mth, Qtr, Yr',
                    },
                    legend: {
                        display: false
                    }
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        bottom: 10,
                        top: 10
                    }
                },
                tooltips: {
                    enabled: false
                }
            }
        });

        let salesChart = new Chart(myChart5, {
            type: 'bar', // bar, horizontalBar, pie, line, doughnut, radarm, polarArea
            data: {
                labels: [ <?php echo($strMonth) ?> , 'Q1', 'Q2', 'Q3', 'Q4', 'Yr'],
                datasets: [{
                    label: 'Sales Billabe ($)',
                    data: [ <?php echo($monthSales)?> , 
                        <?php echo($q1Sales)?> , 
                        <?php echo($q2Sales) ?>, 
                        <?php echo($q3Sales) ?>, 
                        <?php echo($q4Sales) ?>,
                        <?php echo($yearSales)?>
                        
                    ],
                    backgroundColor: [
                        'rgba(138, 154, 249, 0.6)',
                        'rgba(198, 204, 81, 0.6)',
                        'rgba(175, 84, 87, 0.6)',
                        'rgba(106, 15, 206, 0.6)',
                        'rgba(145, 154, 150, 0.6)',
                        'rgba(27, 230, 40, 0.6)'
                    ],
                    borderWidth: 1,
                    borderColor: '#777',
                    hoverBorderWidth: 3,
                    hoverBorderColor: '#000'
                }, ]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Sales Billable By Mth, Qtr, Yr',
                    },
                    legend: {
                        display: false
                    }
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        bottom: 10,
                        top: 10
                    }
                },
                tooltips: {
                    enabled: false
                }
            }
        });

    </script>

</body>




<?php

    $permission = $this->Identity->get('permission_level');

    if ($permission == 'admin') {?>
<!-- ADMIN VIEW BELOW -->

<section class="section ">
    <div class="row">
        <div class="card col-md-8">
            <div class="card-body">
                <h1>Tasks to be Approved and Invoiced</h1>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Employee</th>
                                <th>Task</th>
                                <th>Approved</th>
                                <th>Invoiced</th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentTasks as $recentTask): ?>
                            <tr>
                                <td><?= h($recentTask->date) ?></td>
                                <td><?= h($recentTask->employee->first_name) ?></td>
                                <td><?= h($recentTask->task->task_name) ?></td>
                                <td><?= $recentTask->approval_status ? __('Yes') : __('No'); ?>
                                <td><?= $recentTask->invoice_status ? __('Yes') : __('No'); ?>
                                <td class="actions">
                                    <?= $this->Html->link('', ['action' => 'edit3', $recentTask->employee_tasks_id], ['class' => 'fa fa-pencil-square-o', 'style' => 'margin-right: 10px']) ?>
                                    <?= $this->Form->postLink('', ['action' => 'delete3', $recentTask->employee_tasks_id], ['confirm' => __('Are you sure you want to delete {0} for {1} dated on {2}?', $recentTask->task->task_name, $recentTask->client->company_name, $recentTask->date), 'class' => 'font_color fa fa-trash-o']) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
                        <?=  $this->Paginator->next('>') ?>
                        <?= $this->Paginator->last('>>') ?>
                    </ul>

                    <p><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}') ?>
                    </p>

                </div>

            </div>
        </div>

        <section class="section col-md-4">
            <div class="card">

                <div class="card-body">
                    <?= $this->Form->create() ?>
                    <h2>Review Business Performance</h2>
                    <div class="row">

                        <div class="col-md-6">
                            <p>Start Date</p>
                            <div class="form-group">

                                <?php
                                                echo $this->Form->date('begin', ['class' => 'form-control form-control-user', 'placeholder' => 'Enter begin time']);
                                            ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>End Date</p>
                            <div class="form-group">
                                <?php
                                                echo $this->Form->date('end', ['class' => 'form-control form-control-user', 'placeholder' => 'Enter end time']);
                                            ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php

                                            echo $this->Form->control('employee_id', ['class'=>'form-control form-control-user choices', 'placeholder'=>'Enter employee id', 'empty'=> 'Show all']);
                                        ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                            echo $this->Form->control('client_id', ['class'=>'form-control form-control-user choices', 'placeholder'=>'Enter client id', 'empty'=> 'Show all']);
                                        ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php

                                            echo $this->Form->control('task_id', ['class'=>'form-control form-control-user choices', 'placeholder'=>'Enter task id', 'empty'=> 'Show all']);
                                        ?>
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <div class="form-group">
                                <?php
                                            echo $this->Form->control('invoice_status', ['label' => 'Invoiced', 'type'=>'checkbox', 'class'=>'form-control form-control-user form-check-input', 'placeholder'=>'Enter no invoice status']);
                                            ?>
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <div class="form-group">
                                <?php
                                            echo $this->Form->control('approval_status', ['label' => 'Approved', 'type'=>'checkbox', 'class'=>'form-control form-control-user form-check-input', 'placeholder'=>'Enter no charge status']);
                                            ?>
                            </div>
                        </div>

                        <div class="col-md-3 offset-md-2 ">

                            <div class="form-group">
                                <?php
                                            echo $this->Form->button('Search', ['type' => 'submit', 'class' => 'btn btn-outline-primary me-1 mb-1']);
                                        ?>
                            </div>
                        </div>

                    </div>
                    <?= $this->Form->end() ?>

                    <h2> Results </h2>


                    <table class="table table-bordered ">

                        <tbody>
                            <tr>
                                <th scope="row">Total Tasks Rendered</th>
                                <td><?= $query_count ?> tasks rendered</td>
                            </tr>
                            <tr>
                                <th scope="row">Total Income</th>
                                <td>$<?= $query_sum ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Total Billable Hours</th>
                                <td>
                                    <p id="query_sum_hr"></p>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>

        </section>

    </div>

</section>


<script>
    var min_time = <?php echo json_encode($query_time);?> ;
    var hr_time = min_time / 60;
    var rounded = Math.round(hr_time * 10) / 10;
    document.getElementById("query_sum_hr").innerHTML = rounded + " hours";

</script>

<?php } else {?>
<!-- EMPLOYEE VIEW BELOW -->

<style type="text/css">
    .lie2 {
        text-align: center;
    }

    .lie2 .my_text {
        margin-bottom: 20px;
        padding: 55px 0;
        background: #073763;
    }

    .lie2 .my_text a {
        font-size: 60px;
        color: #fff;
        font-weight: bold;
    }

</style>

<section class="section ">
    <div class="row">
        <div class="card col-md-8">

            <div class="card-body">
                <h2>Your Tasks Rendered at a Glance</h2>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Task</th>
                                <th>Client</th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($recentTasks as $recentTask): ?>
                            <tr>
                                <td><?= h($recentTask->date) ?></td>
                                <td><?= h($recentTask->task->task_name) ?></td>
                                <td><?= h($recentTask->client->company_name) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link('', ['action' => 'edit3', $recentTask->employee_tasks_id], ['class' => 'fa fa-pencil-square-o', 'style' => 'margin-right: 10px']) ?>
                                    <?= $this->Form->postLink('', ['action' => 'delete3', $recentTask->employee_tasks_id], ['confirm' => __('Are you sure you want to delete {0} for {1} dated on {2}?', $recentTask->task->task_name, $recentTask->client->company_name, $recentTask->date), 'class' => 'font_color fa fa-trash-o']) ?>
                                </td>
                            </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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


                    <p><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}') ?>
                    </p>

                </div>
            </div>
        </div>

        <div class=" col-md-4 lie2 ">
            <div class="my_text"><a
                    href="<?= $this->Url->build(['controller' => 'EmployeeTasks', 'action' => 'add']) ?>">Add
                    New<br>Task</a></div>
            <div class="my_text"><a
                    href="<?= $this->Url->build(['controller' => 'EmployeeTasks', 'action' => 'index']) ?>">View
                    all<br>Tasks</a></div>
            <div>

            </div>

</section>

<div style="clear:both"></div>

<?php } ?>
