<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientBillingTotal[]|\Cake\Collection\CollectionInterface $clientBillingTotals
 */
?>
<div class="clientBillingTotals index content">
    <?= $this->Html->link(__('New Client Billing Total'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Client Billing Totals') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('billing_total_id') ?></th>
                    <th><?= $this->Paginator->sort('client_billing_total') ?></th>
                    <th><?= $this->Paginator->sort('billed_status') ?></th>
                    <th><?= $this->Paginator->sort('client_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientBillingTotals as $clientBillingTotal): ?>
                <tr>
                    <td><?= $this->Number->format($clientBillingTotal->billing_total_id) ?></td>
                    <td><?= $this->Number->format($clientBillingTotal->client_billing_total) ?></td>
                    <td><?= h($clientBillingTotal->billed_status) ?></td>
                    <td><?= $clientBillingTotal->has('client') ? $this->Html->link($clientBillingTotal->client->client_id, ['controller' => 'Clients', 'action' => 'view', $clientBillingTotal->client->client_id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $clientBillingTotal->billing_total_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clientBillingTotal->billing_total_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clientBillingTotal->billing_total_id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientBillingTotal->billing_total_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
