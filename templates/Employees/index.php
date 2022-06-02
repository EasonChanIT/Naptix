<head>
    <title>Naptix Employee </title>
</head>


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>

<style>
    .font_color{color: red !important;}
</style>

<div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Employees</h3>

                        </div>
                         <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">

                                <?= $this->Html->link(__('Add New Employee'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
                                </ol>
                            </nav>
                    </div>
                    </div>

                </div>

 <section class="section">
        <div class="card">
            <div class="card-header">
                        
                        <?php echo $this->Form->create(null,['type'=>'get']) ?>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control col-md-2 " name="keyword"  placeholder='<?php echo $this->request->getQuery('keyword') ?>'>

                                </div>
                            </div>

                            <div class="col-md-1 ">
                    
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->button('Search', ['type' => 'submit', 'class' => 'btn btn-outline-primary me-1 mb-1']);
                                    ?>
                                </div>

                            </div>

                            
                            
                        <?php echo $this->Form->end() ?>
                        </div>

                </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                            
                        <thead>
                            <tr>
                    
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Permission Level</th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee): ?>
                            <tr>
                    
                                <td><?= h($employee->first_name) ?></td>
                                <td><?= h($employee->last_name) ?></td>
                                <td><?= h($employee->permission_level) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link('', ['action' => 'view', $employee->employee_id], ['class' => 'fa fa-eye', 'style'=> 'margin-right: 10px']) ?>
                                    <?= $this->Html->link('', ['action' => 'edit', $employee->employee_id], ['class' => 'fa fa-pencil-square-o', 'style'=> 'margin-right: 10px']) ?>
                                    <?= $this->Form->postLink('', ['action' => 'delete', $employee->employee_id], ['confirm' => __('Are you sure you want to delete {0}?', $employee->first_name), 'class' => 'font_color fa fa-trash-o']) ?>
                                </td>
                            </tr>


                            <?php endforeach; ?>
                        </tbody>
                    </table>

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
        </div>

</section>
 


