<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientBillingTotal $clientBillingTotal
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Client Billing Total'), ['action' => 'edit', $clientBillingTotal->billing_total_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Client Billing Total'), ['action' => 'delete', $clientBillingTotal->billing_total_id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientBillingTotal->billing_total_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Client Billing Totals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Client Billing Total'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clientBillingTotals view content">
            <h3><?= h($clientBillingTotal->billing_total_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $clientBillingTotal->has('client') ? $this->Html->link($clientBillingTotal->client->client_id, ['controller' => 'Clients', 'action' => 'view', $clientBillingTotal->client->client_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Billing Total Id') ?></th>
                    <td><?= $this->Number->format($clientBillingTotal->billing_total_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Client Billing Total') ?></th>
                    <td><?= $this->Number->format($clientBillingTotal->client_billing_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Billed Status') ?></th>
                    <td><?= $clientBillingTotal->billed_status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
