<!DOCTYPE html>
<html>
<head>
<title>PDF</title>

</head>
<body>


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
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($query as $employeeTask): ?>
                                <tr>
                                    
                                    <td><?= h($employeeTask->date) ?></td>
                                    <td><?= h($employeeTask->employee->first_name) ?></td>
                                    <td><?= h($employeeTask->task->task_name) ?></td>
                                    <td><?= h($employeeTask->client->company_name) ?></td>
                                    <td><?= h($employeeTask->billable_time) ?> mins</td>
                                    <td><?php
                                    if ($employeeTask->invoice_status == 1) { ?>
                                        <p>yes</p>
                                        
                                    <?php } else {?>
                                        <p>no</p>
                                    <?php } ?></td>
                                    
                                </tr>
                                
                            <?php endforeach; ?>
                            </tbody>
                            </table>
        </div>
</body>
</html>