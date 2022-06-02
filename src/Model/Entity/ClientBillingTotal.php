<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClientBillingTotal Entity
 *
 * @property int $billing_total_id
 * @property int|null $client_billing_total
 * @property bool|null $billed_status
 * @property int $client_id
 *
 * @property \App\Model\Entity\Client $client
 */
class ClientBillingTotal extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'client_billing_total' => true,
        'billed_status' => true,
        'client_id' => true,
        'client' => true,
    ];
}
