<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientBillingTotal $clientBillingTotal
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 */
?>



<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Client Billing Totals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clientBillingTotals form content">
            <?= $this->Form->create($clientBillingTotal) ?>
            <fieldset>
                <legend><?= __('Add Client Billing Total') ?></legend>
                <?php
                    echo $this->Form->control('client_billing_total');
                    echo $this->Form->control('billed_status');
                    echo $this->Form->control('client_id', ['options' => $clients]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>