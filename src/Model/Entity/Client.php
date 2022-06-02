<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $client_id
 * @property string|null $company_name
 * @property string|null $contat_name
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $city
 * @property string|null $state
 * @property int|null $postcode
 * @property string|null $country
 * @property int|null $company_phone_number
 * @property int|null $contact_phone_number
 * @property string|null $contact_email
 */
class Client extends Entity
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
        'company_name' => true,
        'contat_name' => true,
        'address_line_1' => true,
        'address_line_2' => true,
        'city' => true,
        'state' => true,
        'postcode' => true,
        'country' => true,
        'company_phone_number' => true,
        'contact_phone_number' => true,
        'contact_email' => true,
    ];
}
