<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientBillingTotal $clientBillingTotal
 * @var string[]|\Cake\Collection\CollectionInterface $clients
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $clientBillingTotal->billing_total_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $clientBillingTotal->billing_total_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Client Billing Totals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clientBillingTotals form content">
            <?= $this->Form->create($clientBillingTotal) ?>
            <fieldset>
                <legend><?= __('Edit Client Billing Total') ?></legend>
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
