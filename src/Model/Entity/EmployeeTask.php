<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeeTask Entity
 *
 * @property int $employee_tasks_id
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\Time $time
 * @property int $billable_time
 * @property bool|null $approval_status
 * @property bool|null $no_charge_status
 * @property int $employee_id
 * @property int $task_id
 * @property int $client_id
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Task $task
 * @property \App\Model\Entity\Client $client
 */
class EmployeeTask extends Entity
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
        'date' => true,
        'time' => true,
        'billable_time' => true,
        'approval_status' => true,
        'no_charge_status' => true,
        'employee_id' => true,
        'task_id' => true,
        'client_id' => true,
        'employee' => true,
        'task' => true,
        'client' => true,
        'subtotal' => true,
        'invoice_status' => true,
        'task_description' => true
    ];
}
