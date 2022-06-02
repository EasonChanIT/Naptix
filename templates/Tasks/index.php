<head>
    <title>Naptix Tasks (Admin) </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task[]|\Cake\Collection\CollectionInterface $tasks
 */
?>

<style>
    .font_color{color: red !important;}
</style>

<div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Tasks</h3>

                        </div>
                         <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">


                                <?= $this->Html->link(__('Add New Task'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>

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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Task Rate (per hour)</th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?= h($task->task_name) ?></td>
                                <td>$<?= h($task->task_rate) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link('', ['action' => 'edit', $task->task_id], ['class' => 'fa fa-pencil-square-o', 'style'=> 'margin-right: 10px']) ?>
                                    <?= $this->Form->postLink('', ['action' => 'delete', $task->task_id], ['confirm' => __('Are you sure you want to delete {0}?', $task->task_name), 'class' => 'font_color fa fa-trash-o']) ?>
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
                       

                        <p><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}') ?></p>
                        
                    </div>
        </div>
    </div>
</section>


