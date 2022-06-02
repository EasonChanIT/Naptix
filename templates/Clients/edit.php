<head>
    <title> Edit Client </title>
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>


    <div class="page-title">
        <div class="col-12 col-md-6">
            <?= $this->Html->link(__('< Go back to client list'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="row">
            <div class="col-12  order-md-1 order-last">
                <h1>Edit <?= h($client->company_name) ?> Details</h1>
            </div>
            
        </div>

    </div>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">

                            <?= $this->Form->create($client) ?>
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-4 offset-md-1 col-12">
                                        <div class="form-group">

                                             <?php
                                                echo $this->Form->control('company_name', ['class'=>'form-control form-control-user', 'placeholder'=>'Enter company name', 'label' => 'Company Name*']);
                                            ?>
                                        </div>
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



