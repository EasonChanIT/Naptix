<head>
    <title> Naptix Clients </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client[]|\Cake\Collection\CollectionInterface $clients
 */
?>

<style>
    .font_color{color: red !important;}
</style>

<div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Clients</h3>

                        </div>
                         <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">

                               

                                <?= $this->Html->link(__('Add New Client'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
                                </ol>
                            </nav>
                    </div>
                    </div>

                </div>

<section class="section">
    <div class="card">
                    <div class="card-header">
                        <!-- search function-->

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
                                        
                        <th>Client Name</th>
                                        
                        <th class="actions"><?= __('Actions') ?></th>
                        <th class="actions"><?= __('Add new task rendered for this client') ?></th>

                        </tr>
                    </thead>
                    <tbody>
                         <!-- displaying each client in a row-->
                        <?php foreach ($clients as $client): ?>
                        <tr>
                 
                            <td><?= h($client->company_name)?></td>
                   
                            <td class="actions" >
                       
                                <?= $this->Html->link('', ['action' => 'edit', $client->client_id], ['class' => 'fa fa-pencil-square-o', 'style'=> 'margin-right: 10px']) ?>
                                <?= $this->Form->postLink('', ['action' => 'delete', $client->client_id], ['confirm' => __('Are you sure you want to delete {0}?', $client->company_name), 'class' => 'font_color fa fa-trash-o']) ?>
                            </td>

                            <td>
                                 <!-- loads the client_id as company name in the form-->
                                <?= $this->Html->link(__('Add Task'), ['controller' => 'EmployeeTasks','action' => 'add2',$client->client_id]) ?>
                            </td>

                        </tr>

                        <?php endforeach; ?>


                    </tbody>
                </table>
            </div>
            <div class="">
                 <!-- pagination-->
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
 

